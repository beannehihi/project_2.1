<?php

namespace App\Imports;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        // Lấy user_id từ session
        $user_id = request()->session()->get('user_id');

        $studentCode = $row['ma_sinh_vien'];

        $phoneNumber = $row['sdt'];
        if (substr($phoneNumber, 0, 1) !== '0') {
            $phoneNumber = '0' . $phoneNumber;
        }


        return new Student([
            'student_code' => $studentCode,
            'name' => $row['ho_va_ten'],
            'date_of_birth' => Carbon::createFromFormat('d/m/Y', $row['sinh_nhat'])->toDateString(),
            'phone' => $phoneNumber,
            'email' => $row['email'],
            'location' => $row['dia_chi'],
            'scholarship' => $row['hoc_bong'],
            'user_id' => $user_id,
            'password' => $studentCode, // Gán mật khẩu đã được tạo
        ]);
    }


    public function headingRow()
    {
        return 1;
    }
}
