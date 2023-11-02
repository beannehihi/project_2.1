<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function create(Request $request)
    {
        $searchTerm = $request->input('search_term');

        if (!empty($searchTerm)) {
            $majors = Major::where('name', 'like', '%' . $searchTerm . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(6);
        } else {
            $majors = Major::orderBy('created_at', 'desc')->paginate(6);
        }

        return view('pages.major_table', compact('majors'));
    }


    public function add(Request $request)
    {
        $name = $request->input('name');

        if (empty($name)) {
            return redirect()->route('majors')->with('error', 'Tên không được để trống.');
        }

        $existingMajor = Major::where('name', $name)->first();
        if ($existingMajor) {
            return redirect()->route('majors')->with('error', 'Chuyên ngành đã tồn tại.');
        }

        $newMajor = new Major(['name' => $name]);
        $newMajor->save();

        return redirect()->route('majors')->with('success', 'Thêm thành công');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');

        if (empty($id) || empty($name)) {
            return redirect()->route('majors')->with('error', 'ID hoặc tên không được để trống.');
        }

        $major = Major::find($id);
        if (!$major) {
            return redirect()->route('majors')->with('error', 'Không tìm thấy chuyên ngành');
        }

        $major->name = $name;
        $major->save();

        return redirect()->route('majors')->with('success', 'Cập nhật chuyên ngành thành công');
    }

    public function delete($id)
    {
        if (empty($id)) {
            return redirect()->route('majors')->with('error', 'ID không được để trống.');
        }

        $major = Major::find($id);
        if (!$major) {
            return redirect()->route('majors')->with('error', 'Không tìm thấy chuyên ngành.');
        }

        if ($major->fees()->count() > 0) {
            return redirect()->route('majors')->with('error', 'Không thể xóa chuyên ngành này vì nó đang được sử dụng.');
        }

        $major->delete();
        return redirect()->route('majors')->with('success', 'Xóa chuyên ngành thành công');
    }
}
