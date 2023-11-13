<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Major;
use App\Models\SchoolYear;
use App\Models\Tuition_fee;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class FeeController extends Controller
{
    public function create(Request $request)
    {
        $searchTerm = $request->input('search_term');

        if (!empty($searchTerm)) {
            $fees = Fees::whereHas('schoolYear', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
                ->orWhereHas('major', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(6);
        } else {
            $fees = Fees::orderBy('created_at', 'desc')->paginate(6);
        }

        $majors = Major::all();
        $schoolYears = SchoolYear::all();

        return view('pages.fee_table', compact('fees', 'schoolYears', 'majors'));
    }


    public function add(Request $request)
    {
        $name_fee = $request->input('name');
        $total_fee = $request->input('total_fee');
        $schoolYear_id = $request->input('schoolYear_id');
        $major_id = $request->input('major_id');

        if (empty($total_fee) || empty($schoolYear_id) || empty($major_id)) {
            toastr()->addError('khoản phí đã tồn tại.');
            return redirect()->route('fees');
        }

        $month = $request->input('month', 1);

        $newFee = new Fees([
            'name' => $name_fee,
            'month' => $month,
            'total_fee' => $total_fee,
            'schoolYear_id' => $schoolYear_id,
            'major_id' => $major_id,
        ]);

        $newFee->save();

        toastr()->addSuccess('thêm khoản phí thành công.');
        return redirect()->route('fees');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $name_fee = $request->input('name');
        $month = $request->input('month');
        $schoolYear_id = $request->input('schoolYear_id');
        $major_id = $request->input('major_id');

        if (empty($id) || empty($month) || empty($schoolYear_id) || empty($major_id) || empty($name_fee)) {
            toastr()->addError('khoản phí đã tồn tại.');
            return redirect()->route('fees');
        }

        $fee = Fees::find($id);

        if (!$fee) {
            toastr()->addError('khoản phí đã tồn tại.');

            return redirect()->route('fees');
        }



        $fee->name = $name_fee;
        $fee->month = $month;
        $fee->schoolYear_id = $schoolYear_id;
        $fee->major_id = $major_id;
        $fee->save();
        toastr()->addSuccess('cập nhật khoản phí thành công.');

        return redirect()->route('fees');
    }



    public function delete($id)
    {
        if (empty($id)) {
            toastr()->addError('khoản phí không tồn tại.');
            return redirect()->route('fees');
        }

        $fee = Fees::find($id);

        if (!$fee) {
            toastr()->addError('khoản phí không tồn tại.');

            return redirect()->route('fees');
        }

        if ($fee->tuition_fee()->exists()) {
            toastr()->addError('không thể xóa khoản phí.');

            return redirect()->route('fees');
        }

        if ($fee->students()->exists()) {
            toastr()->addError('không thể xóa khoản phí.');

            return redirect()->route('fees');
        }

        $fee->delete();
        toastr()->addSuccess('xóa khoản phí thành công.');

        return redirect()->route('fees');
    }
}
