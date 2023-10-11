<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function create()
    {
        return view('pages.major_table');
    }
}
