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
            toastr()->addError('Tên không được để trống.');
            return redirect()->route('majors');
        }

        $existingMajor = Major::where('name', $name)->first();
        if ($existingMajor) {
            toastr()->addError('Chuyên ngành đã tồn tại.');

            return redirect()->route('majors');
        }

        $newMajor = new Major(['name' => $name]);
        $newMajor->save();
        toastr()->addSuccess('Thêm thành công');

        return redirect()->route('majors');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');

        if (empty($id) || empty($name)) {
            toastr()->addError('ID hoặc tên không được để trống.');

            return redirect()->route('majors');
        }

        $major = Major::find($id);
        if (!$major) {
            toastr()->addError('Không tìm thấy chuyên ngành');

            return redirect()->route('majors');
        }

        $major->name = $name;
        $major->save();
        toastr()->addSuccess('Cập nhật chuyên ngành thành công');

        return redirect()->route('majors');
    }

    public function delete($id)
    {
        if (empty($id)) {
            toastr()->addError('ID không được để trống.');
            return redirect()->route('majors');
        }

        $major = Major::find($id);
        if (!$major) {
            toastr()->addError('Không tìm thấy chuyên ngành.');

            return redirect()->route('majors');
        }

        if ($major->fees()->count() > 0) {
            toastr()->addError('Không thể xóa chuyên ngành này vì nó đang được sử dụng.');

            return redirect()->route('majors');
        }

        $major->delete();
        toastr()->addSuccess('Xóa chuyên ngành thành công');


        return redirect()->route('majors');
    }
}
