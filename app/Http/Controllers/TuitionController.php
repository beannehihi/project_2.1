<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Student;
use App\Models\Tuition_fee;
use Illuminate\Http\Request;
use PDF;

class TuitionController extends Controller
{
    public function create(Request $request)
    {
        $fees = Fees::all();

        // Lấy giá trị từ input search theo 'student_code'
        $search = $request->input('student_code');

        // Nếu giá trị search không tồn tại hoặc rỗng, hiển thị toàn bộ dữ liệu
        if (empty($search)) {
            $tuitionFees = Tuition_fee::with('student')->paginate(7);
        } else {
            // Tìm kiếm dựa trên 'student_code'
            $tuitionFees = Tuition_fee::whereHas('student', function ($query) use ($search) {
                $query->where('student_code', 'LIKE', "%$search%");
            })->with('student')->paginate(7);
        }

        return view('pages.tuition', compact('fees', 'tuitionFees'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_code' => 'required|exists:students,student_code',
            'times' => 'required',
            'fee_id' => 'required',
            'fee' => 'required|numeric',
        ]);

        try {
            $student = Student::where('student_code', $validatedData['student_code'])->first();

            if ($student) {
                $tuitionFee = new Tuition_fee();
                $tuitionFee->student_id = $student->id;
                $tuitionFee->times = $validatedData['times'];
                $tuitionFee->fee_id = $validatedData['fee_id'];
                $tuitionFee->fee = $validatedData['fee'];
                $tuitionFee->save();

                return redirect()->route('tuition')->with('success', 'Học phí của sinh viên ' . $validatedData['student_code'] . ' đã được thêm mới thành công!');
            } else {
                return back()->with('error', 'Không tìm thấy thông tin sinh viên với mã ' . $validatedData['student_code']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Đã xảy ra lỗi. Không thể thêm mới học phí: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'student_code' => 'required|exists:students,student_code',
            'times' => 'required',
            'fee_id' => 'required',
            'fee' => 'required|numeric',
        ]);

        try {
            $tuitionFee = Tuition_fee::find($id);

            if ($tuitionFee) {
                $student = Student::where('student_code', $validatedData['student_code'])->first();

                if ($student) {
                    $tuitionFee->student_id = $student->id;
                    $tuitionFee->times = $validatedData['times'];
                    $tuitionFee->fee_id = $validatedData['fee_id'];
                    $tuitionFee->fee = $validatedData['fee'];
                    $tuitionFee->save();
                    $tuitionFee->touch();
                    return redirect()->route('tuition')->with('success', 'Thông tin học phí đã được cập nhật!');
                } else {
                    return back()->with('error', 'Không tìm thấy thông tin sinh viên với mã ' . $validatedData['student_code']);
                }
            } else {
                return back()->with('error', 'Không tìm thấy thông tin học phí để cập nhật.');
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Đã xảy ra lỗi. Không thể cập nhật học phí: ' . $e->getMessage());
        }
    }

    public function printReceipt($id)
    {
        $tuitionFee = Tuition_fee::with(['student', 'fees'])->findOrFail($id);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pages.print', ['tuitionFee' => $tuitionFee]);

        return $pdf->download('receipt.pdf');
    }
}
