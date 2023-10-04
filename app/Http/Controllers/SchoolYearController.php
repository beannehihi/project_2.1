<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolYearController extends Controller
{

    // School year
    public function create()
    {
        $schoolYears = SchoolYear::all();
        $classes = Classes::all();

        return view('pages.schoolYear_table', compact('schoolYears', 'classes'));
    }

    public function add(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $schoolYear = SchoolYear::where('name', $validateData['name'])->first();

        if ($schoolYear) {
            return redirect()->route('school_years')->with('error', 'liên khóa đã tồn tại.');
        }

        $newSchoolYear = new SchoolYear([
            'name' => $validateData['name'],
        ]);

        $newSchoolYear->save();

        return redirect()->route('school_years')->with('success', 'Thêm thành công');
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $schoolYear = SchoolYear::find($id);

        if (!$schoolYear) {
            return redirect()->route('school_years')->with('error', 'School Year không tồn tại.');
        }

        $existingSchoolYear = SchoolYear::where('name', $validateData['name'])
            ->where('id', '!=', $id)
            ->first();

        if ($existingSchoolYear) {
            return redirect()->route('school_years')->with('error', 'School Year đã tồn tại.');
        }

        $schoolYear->name = $validateData['name'];
        $schoolYear->save();

        return redirect()->route('school_years')->with('success', 'School Year đã được cập nhật thành công.');
    }
}
