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

        $tuitionFees = Tuition_fee::with('student')->get();

        return view('pages.tuition', compact('fees', 'tuitionFees'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'student_code' => 'required',
            'times' => 'required|numeric|min:1',
            'fee_id' => 'required',
            'fee' => 'required|numeric|min:0',
        ]);

        // Find the student based on the provided student code
        $student = Student::where('student_code', $request->student_code)->first();

        if ($student) {
            $times = $request->times;
            $fee = $request->fee;
            $fee_id = $request->fee_id;

            // Find the specific fee based on the provided fee_id
            $specificFee = Fees::find($fee_id);

            if ($specificFee) {
                $total_fee = $specificFee->total_fee;
                $scholarship = $student->scholarship;

                // Calculate the amount to be paid per installment
                $amountPerInstallment = ($total_fee - $scholarship) / $times;

                for ($i = 1; $i <= $times; $i++) {
                    $tuitionFee = new Tuition_fee();
                    $tuitionFee->student_id = $student->id;
                    $tuitionFee->fee_id = $fee_id;
                    $tuitionFee->times = $i;
                    $tuitionFee->money = $amountPerInstallment;
                    $tuitionFee->save();
                }

                toastr()->addSuccess('Học phí đã được tạo thành công.');
                return redirect()->route('tuition');
            } else {
                toastr()->addError('Không tìm thấy thông tin học phí.');
                return redirect()->back();
            }
        } else {
            toastr()->addError('Không tìm thấy sinh viên.');
            return redirect()->back();
        }
    }
}
