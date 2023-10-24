<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Major;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    public function create($id, Request $request)
    {
        $searchText = $request->input('search_text');
        $classes = Classes::with('schoolYear', 'students')->find($id);

        $studentsQuery = Student::where('class_id', $id);

        if ($searchText !== null) {
            $studentsQuery->where('student_code', 'like', "%$searchText%");
        }

        $students = $studentsQuery->paginate(7);
        $majors = Major::all();

        $studentCount = $students->total();

        return view('pages.classes_table', compact('classes', 'students', 'studentCount', 'majors', 'searchText'));
    }


    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'student_code' => 'required',
            'img' => 'nullable',
            'name' => 'nullable',
            'date_of_birth' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required|email|unique:students,email',
            'password' => 'nullable',
            'location' => 'nullable',
            'gender' => 'nullable',
            'role' => 'nullable',
            'user_id' => 'nullable',
            'class_id' => 'required',
            'major_id' => 'required',
        ]);

        $student_code = 'BKC-' . $validatedData['student_code'];
        $role = $validatedData['role'] ?? 3;
        $user_id = $validatedData['user_id'] ?? Auth::id();
        $password = $validatedData['password'] ?? $student_code;
        $student = new Student([
            'student_code' => $student_code,
            'img' => $validatedData['img'],
            'name' => $validatedData['name'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'password' => $password,
            'location' => $validatedData['location'],
            'gender' => $validatedData['gender'],
            'role' => $role,
            'user_id' => $user_id,
            'class_id' => $validatedData['class_id'],
            'major_id' => $validatedData['major_id'],
        ]);

        $student->save();

        toastr()->addSuccess('Thêm sinh viên thành công.');

        return redirect()->back();
    }

    public function delete($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            toastr()->addSuccess('Xóa sinh viên thành công.');
        } else {
            toastr()->addError('Không tìm thấy sinh viên để xóa.');
        }

        return redirect()->back();
    }
}
