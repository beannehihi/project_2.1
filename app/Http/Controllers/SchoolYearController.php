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
    public function create(Request $request)
    {
        $searchTerm = $request->input('search_term');

        if (!empty($searchTerm)) {
            $schoolYears = SchoolYear::where('name', 'like', '%' . $searchTerm . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(6);
        } else {
            $schoolYears = SchoolYear::orderBy('created_at', 'desc')->paginate(6);
        }

        return view('pages.schoolYear_table', compact('schoolYears'));
    }


    public function add(Request $request)
    {
        $name = $request->input('name');

        if (empty($name)) {
            // Nếu dữ liệu không hợp lệ, in ra thông báo lỗi
            return redirect()->route('school_years')->with('error', 'Tên không được để trống.');
        }

        $schoolYear = SchoolYear::where('name', $name)->first();
        if ($schoolYear) {
            return redirect()->route('school_years')->with('error', 'Liên khóa đã tồn tại.');
        }

        $newSchoolYear = new SchoolYear(['name' => $name]);
        $newSchoolYear->save();

        return redirect()->route('school_years')->with('success', 'Thêm thành công');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');

        if (empty($id) || empty($name)) {
            return redirect()->route('school_years')->with('error', 'ID và tên không được để trống.');
        }

        $schoolYear = SchoolYear::find($id);
        if (!$schoolYear) {
            return redirect()->route('school_years')->with('error', 'Không tìm thấy School Year');
        }

        $schoolYear->name = $name;
        $schoolYear->save();

        toastr()->addSuccess('Cập nhật liên khóa thành công.');
        return redirect()->route('school_years');
    }

    public function delete($id)
    {
        if (empty($id)) {
            return redirect()->route('school_years')->with('error', 'ID không được để trống.');
        }

        $schoolYear = SchoolYear::find($id);

        if (!$schoolYear) {
            return redirect()->route('school_years')->with('error', 'Không tìm thấy School Year');
        }

        if ($schoolYear->students()->count() > 0 || $schoolYear->fees()->count() > 0) {
            return redirect()->route('school_years')->with('error', 'Không thể xóa School Year có liên kết với học sinh hoặc các khoản phí.');
        }

        $schoolYear->delete();

        toastr()->addSuccess('Xóa School Year thành công');
        return redirect()->route('school_years');
    }
}
