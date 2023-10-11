<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Class_;

class SchoolYearController extends Controller
{

    // School year
    public function create()
    {
        $classes = Classes::all();

        $schoolYears = SchoolYear::select('id', 'name')
            ->selectSub(function ($query) {
                $query->selectRaw('count(*)')
                    ->from('classes')
                    ->whereColumn('schoolYear_id', 'school_years.id')
                    ->groupBy('schoolYear_id');
            }, 'total_classes')
            ->get();


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


    public function addClass(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'schoolYear_id' => 'required',
        ]);

        $existingClass = Classes::where('name', $validateData['name'])
            ->where('schoolYear_id', $validateData['schoolYear_id'])
            ->exists();

        if ($existingClass) {
            return redirect()->route('school_years')->with('error', 'Lớp đã tồn tại trong năm học này');
        }

        Classes::create([
            'name' => $validateData['name'],
            'schoolYear_id' => $validateData['schoolYear_id'],
        ]);

        return redirect()->route('school_years')->with('success', 'Thêm lớp thành công');
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $schoolYear = SchoolYear::find($id);

        if (!$schoolYear) {
            return redirect()->route('school_years')->with('error', 'Không tìm thấy schoolYear');
        }

        $schoolYear->name = $validateData['name'];
        $schoolYear->save();

        return redirect()->route('school_years')->with('success', 'Cập nhật tên schoolYear thành công');
    }
}
