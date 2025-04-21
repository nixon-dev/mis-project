<?php

namespace App\Http\Controllers;

use App\Models\BudgetHistory;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BMController extends Controller
{
    public function management()
    {

        $data = Office::orderBy('office_name', 'ASC')->get();

        return view('staff.budget.management', compact('data'));
    }

    public function view($id)
    {
        $check = Office::where('office_id', $id)->exists();

        if (!$check) {
            return redirect()->route('management.list')->with('error', 'No Office Found');
        }

        $data = Office::where('office_id', $id)->first();


        $history = BudgetHistory::where('office_budget.office_id', $id)
            ->leftJoin('users as u', 'u.id', '=', 'office_budget.ob_allocated_by')
            ->get();

        return view('staff.budget.management-view', compact('data', 'history'));
    }

    public function allocate(Request $request)
    {

        $oldBudgetAmount = Office::where('office_id', $request->office_id)->first()->office_budget;

        $newBudgetAmount = $oldBudgetAmount + $request->budget_amount;

        $query = Office::where('office_id', $request->office_id)
            ->update([
                'office_budget' => $newBudgetAmount,
            ]);


        BudgetHistory::insert([
            'ob_allocated_by' => Auth::user()->id,
            'office_id' => $request->office_id,
            'ob_allocated_amount' => $request->budget_amount,
            'ob_remarks' => $request->budget_remarks,
        ]);

        if ($query) {
            return back()->with('success', 'Budget allocated successfully!');
        } else {
            return back()->with('error', 'Failed to allocate budget');
        }
    }
}
