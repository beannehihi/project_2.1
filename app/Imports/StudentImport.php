<?php

namespace App\Imports;

use App\Models\Fees;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class StudentImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $user_id = request()->session()->get('user_id');

        $studentCode = $row['ma_sinh_vien'];

        $phoneNumber = $row['sdt'];
        if (substr($phoneNumber, 0, 1) !== '0') {
            $phoneNumber = '0' . $phoneNumber;
        }

        $email = $row['email'];

        if (Student::where('email', $email)->exists()) {
            toastr()->addError("Email '$email' đã tồn tại.");
            return null;
        }

        $feeName = $row['hoc_phi'];
        $fee = Fees::where('name', $feeName)->value('id');

        $excelDate = $row['sinh_nhat'];

        $timestamp = strtotime($excelDate);

        $dateOfBirth = date('Y-m-d', $timestamp);

        return new Student([
            'student_code' => $studentCode,
            'name' => $row['ho_va_ten'],
            'date_of_birth' => $dateOfBirth,
            'phone' => $phoneNumber,
            'email' => $email,
            'location' => $row['dia_chi'],
            'scholarship' => $row['hoc_bong'],
            'user_id' => $user_id,
            'password' => $studentCode,
            'fee_id' => $fee,
        ]);
    }


    public function headingRow()
    {
        return 1;
    }
}
