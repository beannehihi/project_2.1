<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    public function create()
    {
        return view('pages.schoolYear_table');
    }

    public function add()
    {
    }
}
