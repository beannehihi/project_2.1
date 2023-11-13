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
        $studentCode = $request->input('search_term');
        $showAllStudents = true;

        if (empty($studentCode)) {
            $tuitionFees = Tuition_fee::paginate(7);
        } else {
            $tuitionFees = Tuition_fee::whereHas('student', function ($query) use ($studentCode) {
                $query->where('student_code', 'like', '%' . $studentCode . '%');
            })->paginate(7);

            $showAllStudents = false;
        }

        $feesWithStudents = Fees::with(['students', 'major', 'schoolYear'])->get();
        $feesOptions = $feesWithStudents->map(function ($fee) {
            return $fee->students->map(function ($student) use ($fee) {
                return [
                    'student_id' => $student->id,
                    'fee_id' => $fee->id,
                    'description' => "{$fee->schoolYear->name} - Chuyên ngành: {$fee->major->name} - tên sinh viên {$student->name} - mã sinh viên: {$student->student_code} "
                ];
            });
        })->collapse();

        return view('pages.tuition', compact('feesOptions', 'tuitionFees', 'showAllStudents'));
    }


    public function update(Request $request, $id)
    {
        $times = $request->input('times');

        $request->validate([
            'times' => 'required|integer|min:1',
        ]);


        Tuition_fee::where('id', $id)->update(['times' => $times]);
        toastr()->addsuccess('Đã cập nhật số lần thành công cho tuition.');
        return back();
    }



    public function printReceipt($id)
    {
        $tuitionFee = Tuition_fee::with(['student', 'fees'])->findOrFail($id);
        $calculatedValue = (($tuitionFee->fees->total_fee - $tuitionFee->student->scholarship) / 30) * max(0, $tuitionFee->fees->month - $tuitionFee->times);
        return view('pages.print', ['tuitionFee' => $tuitionFee, 'calculatedValue' => $calculatedValue]);
    }
}
