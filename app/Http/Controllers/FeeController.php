<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Major;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

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
        $total_fee = $request->input('total_fee');
        $schoolYear_id = $request->input('schoolYear_id');
        $major_id = $request->input('major_id');

        if (empty($total_fee) || empty($schoolYear_id) || empty($major_id)) {
            return redirect()->route('fees')->with('error', 'Please provide all required fields.');
        }

        $month = $request->input('month', 1);

        $newFee = new Fees([
            'month' => $month,
            'total_fee' => $total_fee,
            'schoolYear_id' => $schoolYear_id,
            'major_id' => $major_id,
        ]);

        $newFee->save();

        return redirect()->route('fees')->with('success', 'Fee added successfully.');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $month = $request->input('month');
        $schoolYear_id = $request->input('schoolYear_id');
        $major_id = $request->input('major_id');

        if (empty($id) || empty($month) || empty($schoolYear_id) || empty($major_id)) {
            return redirect()->route('fees')->with('error', 'Please provide all required fields.');
        }

        $fee = Fees::find($id);

        if (!$fee) {
            return redirect()->route('fees')->with('error', 'Fee not found');
        }

        $fee->month = $month;
        $fee->schoolYear_id = $schoolYear_id;
        $fee->major_id = $major_id;
        $fee->save();

        return redirect()->route('fees')->with('success', 'Fee updated successfully.');
    }

    public function delete($id)
    {
        if (empty($id)) {
            return redirect()->route('fees')->with('error', 'ID not provided.');
        }

        $fee = Fees::find($id);

        if (!$fee) {
            return redirect()->route('fees')->with('error', 'Fee not found');
        }

        if ($fee->tuition_fee()->exists()) {
            return redirect()->route('fees')->with('error', 'Cannot delete this fee because it is associated with tuition fees.');
        }

        $fee->delete();

        return redirect()->route('fees')->with('success', 'Fee deleted successfully.');
    }
}
