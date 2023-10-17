<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function create()
    {
        $majors = Major::orderBy('created_at', 'desc')->paginate(7);


        return view('pages.major_table', compact('majors'));
    }

    public function add(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $majors = Major::where('name', $validateData['name'])->first();

        if ($majors) {
            return redirect()->route('majors')->with('error', 'Chuyên ngành đã tồn tại.');
        }

        $newMajors = new Major([
            'name' => $validateData['name'],
        ]);

        $newMajors->save();

        notyf()->addSuccess('Thêm Thành công.');
        return redirect()->route('majors');
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $major = Major::find($id);

        if (!$major) {
            return redirect()->route('majors')->with('error', 'Không tìm thấy chuyên ngành');
        }

        $major->name = $validateData['name'];
        $major->save();

        toastr()->addSuccess('cập nhật chuyên ngành thành công.');
        return redirect()->route('majors');
    }

    public function delete($id)
    {
        $major = Major::find($id);

        if ($major) {
            $major->delete();
            toastr()->addSuccess('Xóa thành công');
            return redirect()->route('majors');
        } else {
            toastr()->addError('không thể xóa chuyên ngành này.');
            return redirect()->route('majors');
        }
    }
}
