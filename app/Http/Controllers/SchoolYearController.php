<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Fees;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Class_;

class SchoolYearController extends Controller
{

    // School year
    public function create()
    {
        $schoolYears = SchoolYear::orderBy('created_at', 'desc')->paginate(6);

        return view('pages.schoolYear_table', compact('schoolYears'));
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
            return redirect()->route('school_years')->with('error', 'Không tìm thấy schoolYear');
        }

        $schoolYear->name = $validateData['name'];
        $schoolYear->save();


        toastr()->addSuccess('cập nhật chuyên ngành thành công.');
        return redirect()->route('school_years');
    }

    public function delete($id)
    {
        $schoolYear = SchoolYear::find($id);

        if (!$schoolYear) {
            return redirect()->route('school_years')->with('error', 'Không tìm thấy schoolYear');
        }

        if ($schoolYear->students()->count() > 0 || $schoolYear->fees()->count() > 0) {
            return redirect()->route('school_years')->with('error', 'Không thể xóa schoolYear có liên kết với học sinh hoặc các khoản phí.');
        }

        $schoolYear->delete();

        toastr()->addSuccess('Xóa schoolYear thành công');
        return redirect()->route('school_years');
    }
}
