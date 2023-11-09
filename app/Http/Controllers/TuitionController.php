<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Student;
use App\Models\Tuition_fee;
use Illuminate\Http\Request;
use PDF;

use function Ramsey\Uuid\v1;

class TuitionController extends Controller
{
    public function create(Request $request)
    {
        $tuitionFees = Tuition_fee::all();;
        $feesWithStudents = Fees::with(['students', 'major', 'schoolYear'])->get();

        $feesOptions = $feesWithStudents->map(function ($fee) {
            return $fee->students->map(function ($student) use ($fee) {
                return [
                    'student_id' => $student->id,
                    'description' => "{$fee->schoolYear->name} - Chuyên ngành: {$fee->major->name} - mã sinh viên: {$student->student_code} - tổng tiền: {$fee->total_fee} VND"
                ];
            });
        })->collapse(); // Use collapse() instead of flatten() if each element is an array


        return view('pages.tuition', compact('feesOptions', 'tuitionFees'));
    }


    public function store(Request $request)
    {
        // Lấy dữ liệu từ request
        $studentIds = $request->input('student_ids');
        $times = $request->input('times');
        $fee = $request->input('fee');

        // Validate dữ liệu đầu vào
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'required|exists:students,id',
            'times' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0'
        ]);


        foreach ($studentIds as $studentId) {
            $student = Student::findOrFail($studentId);

            // Kiểm tra xem học phí đã tồn tại chưa
            $tuitionExists = Tuition_fee::where('student_id', $studentId)
                ->where('fee_id', $student->fee_id)
                ->exists();

            // Nếu học phí chưa tồn tại, tạo bản ghi mới
            if (!$tuitionExists) {
                Tuition_fee::create([
                    'student_id' => $studentId,
                    'fee_id' => $student->fee_id,
                    'times' => $times,
                    'fee' => $fee
                ]);
            }
        }

        // Chuyển hướng với thông báo phù hợp
        if (isset($tuitionExists) && $tuitionExists) {
            return back()->with('warning', 'Một số học phí đã tồn tại và không được thêm.');
        } else {
            return back()->with('success', 'Đã thêm học phí thành công cho sinh viên.');
        }
    }


    public function update(Request $request)
    {
        // Lấy dữ liệu từ request
        $studentIds = $request->input('student_ids');
        $times = $request->input('times');

        // Validate dữ liệu đầu vào
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'required|exists:students,id',
            'times' => 'required|integer|min:1',
        ]);

        // Lặp qua danh sách sinh viên và cập nhật số lần đóng
        foreach ($studentIds as $studentId) {
            Tuition_fee::where('student_id', $studentId)->update(['times' => $times]);
        }

        return back()->with('success', 'Đã cập nhật số lần đóng thành công cho các sinh viên.');
    }




    public function printReceipt($id)
    {
        $tuitionFee = Tuition_fee::with(['student', 'fees'])->findOrFail($id);
        return view('pages.print', ['tuitionFee' => $tuitionFee]); // The 'pages.print' view should be set up for printing
    }
}
