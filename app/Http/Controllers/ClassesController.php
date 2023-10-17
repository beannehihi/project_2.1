<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function create($id)
    {
        $classes = Classes::with('schoolYear')->find($id);

        $students = Student::where('class_id', $id)->get();

        $studentCount = $students->count();

        return view('pages.classes_table', compact('classes', 'students', 'studentCount'));
    }
}
