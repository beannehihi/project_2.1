<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // count the number
        $studentsCount = Student::count();
        $majorsCount =  Major::count();
        $schoolYearCount = SchoolYear::count();


        return view('dashboard.index', compact('studentsCount', 'majorsCount', 'schoolYearCount'));
    }
}
