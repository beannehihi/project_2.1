<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    //
    public function create(Request $request)
    {
        $searchTerm = $request->input('search_term');
        if (!empty($searchTerm)) {

            $students = Student::where(function ($query) use ($searchTerm) {
                $query->where('student_code', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $searchTerm . '%');
            })->orderBy('created_at', 'desc')->paginate(6);
        } else {

            $students = Student::orderBy('created_at', 'desc')->paginate(6);
        }

        return view('pages.student', compact('students', 'searchTerm'));
    }


    public function import(Request $request)
    {
        try {
            $user_id = Auth::id();

            session(['user_id' => $user_id]);

            $file = $request->file('importExcel');
            $data = Excel::toArray(new StudentImport(), $file);

            $emails = collect($data)->flatten(1)->pluck('email')->toArray();

            $existingEmails = Student::whereIn('email', $emails)->pluck('email')->toArray();

            if (!empty($existingEmails)) {
                toastr()->addError('email đang bị trùng');
            } else {
                Excel::import(new StudentImport(), $file);
                toastr()->addSuccess('Thêm sinh viên thành công.');
            }
        } catch (\Exception $e) {
            toastr()->error('Đã xảy ra lỗi trong quá trình nhập dữ liệu.' . $e->getMessage());
        }

        return redirect()->back();
    }



    public function add(Request $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validate([
                'student_code' => 'required',
                'name' => 'nullable',
                'date_of_birth' => 'nullable',
                'phone' => 'nullable',
                'email' => 'required|email|unique:students,email',
                'password' => 'nullable',
                'location' => 'nullable',
                'scholarship' => 'nullable',
                'gender' => 'nullable',
                'role' => 'nullable',
                'user_id' => 'nullable',
            ]);

            $student_code = 'BKC-' . $validatedData['student_code'];

            $role = $validatedData['role'] ?? 3;
            $user_id = $validatedData['user_id'] ?? Auth::id();

            $password = $validatedData['password'] ?? $student_code;

            $student = new Student([
                'student_code' => $student_code,
                'name' => $validatedData['name'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'password' => $password,
                'location' => $validatedData['location'],
                'scholarship' => $validatedData['scholarship'],
                'gender' => $validatedData['gender'],
                'role' => $role,
                'user_id' => $user_id,
            ]);

            $student->save();

            toastr()->addSuccess('Thêm sinh viên thành công.');

            return redirect()->route('students');
        } else {

            toastr()->addError('Vui lòng đăng nhập trước khi thêm sinh viên.');
            return redirect()->route('login');
        }
    }


    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $student = Student::find($id);

            if ($student) {
                $validatedData = $request->validate([
                    'name' => 'nullable',
                    'date_of_birth' => 'nullable',
                    'phone' => 'nullable',
                    'email' => 'required|email|unique:students,email,' . $id,
                    'password' => 'nullable',
                    'location' => 'nullable',
                    'scholarship' => 'nullable',
                    'gender' => 'nullable',
                ]);

                $student->name = $validatedData['name'];
                $student->date_of_birth = $validatedData['date_of_birth'];
                $student->phone = $validatedData['phone'];
                $student->email = $validatedData['email'];
                $student->location = $validatedData['location'];
                $student->scholarship = $validatedData['scholarship'];
                $student->gender = $validatedData['gender'];

                if (!empty($validatedData['password'])) {
                    $student->password = $validatedData['password'];
                }

                // Lấy ID của người đang đăng nhập và gán cho trường 'user_id'
                $student->user_id = Auth::id();

                $student->save();

                toastr()->addSuccess('Cập nhật thông tin sinh viên thành công.');

                return redirect()->route('students');
            } else {
                toastr()->addError('Không tìm thấy sinh viên để cập nhật.');
                return redirect()->route('students');
            }
        } else {
            toastr()->addError('Vui lòng đăng nhập trước khi cập nhật thông tin sinh viên.');
            return redirect()->route('login');
        }
    }




    public function delete($id)
    {
        if (Auth::check()) {
            $student = Student::find($id);

            if ($student) {
                $student->delete();

                toastr()->addSuccess('Xóa sinh viên thành công.');

                return redirect()->route('students');
            } else {
                toastr()->addError('Không tìm thấy sinh viên để xóa.');
                return redirect()->route('students');
            }
        } else {
            toastr()->addError('Vui lòng đăng nhập trước khi xóa sinh viên.');
            return redirect()->route('login');
        }
    }
}
