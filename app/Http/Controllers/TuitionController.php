<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Tuition_fee;
use Illuminate\Http\Request;

class TuitionController extends Controller
{
    public function create()
    {

        $students = Student::paginate(7);

        return view('pages.tuition', compact('students'));
    }
}
