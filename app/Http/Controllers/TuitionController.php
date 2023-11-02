<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Fees;
use App\Models\Student;
use App\Models\Tuition_fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TuitionController extends Controller
{
    public function create()
    {
        $fees = Fees::all();

        $tuitionFees = Tuition_fee::with('student')->paginate(7);

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

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'student_code' => 'required|exists:students,student_code'
        ]);

        try {
            $studentCode = $validatedData['student_code'];

            $tuitionFees = Tuition_fee::with('student')
                ->whereHas('student', function ($query) use ($studentCode) {
                    $query->where('student_code', $studentCode);
                })
                ->get();

            if ($tuitionFees->isNotEmpty()) {
                $fees = Fees::all();

                return view('pages.tuition', compact('fees', 'tuitionFees'));
            } else {
                return back()->with('error', 'Không tìm thấy học phí cho mã sinh viên ' . $studentCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Đã xảy ra lỗi khi tìm kiếm theo mã sinh viên: ' . $e->getMessage());
        }
    }
}
