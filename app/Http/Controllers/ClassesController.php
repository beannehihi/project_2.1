<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function create()
    {
        return view('pages.classes_table');
    }
}
