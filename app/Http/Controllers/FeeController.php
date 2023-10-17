<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Major;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function create()
    {
        $fees = Fees::orderBy('created_at', 'desc')->paginate(7);

        $majors = Major::all();

        $schoolYears = SchoolYear::all();

        return view('pages.fee_table', compact('fees', 'schoolYears', 'majors'));
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required',
            'total_fee' => 'required',
            'schoolYear_id' => 'required',
            'major_id' => 'required',
        ]);

        $newFee = new Fees([
            'month' => $validatedData['month'],
            'total_fee' => $validatedData['total_fee'],
            'schoolYear_id' => $validatedData['schoolYear_id'],
            'major_id' => $validatedData['major_id'],
        ]);

        $newFee->save();

        toastr()->addSuccess('Fee added successfully.');
        return redirect()->route('fees');
    }

    public function delete($id)
    {
        // Find the Fee record by ID
        $fee = Fees::find($id);

        if (!$fee) {
            return redirect()->route('fees')->with('error', 'Fee not found');
        }

        // Delete the Fee record
        $fee->delete();

        return redirect()->route('fees')->with('success', 'Fee deleted successfully');
    }
}
