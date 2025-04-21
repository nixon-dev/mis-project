<?php

namespace App\Http\Controllers;

use App\Models\BudgetHistory;
use App\Models\Office;
use Illuminate\Http\Request;

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


        $history = BudgetHistory::where('ob.office_id', $id)
            ->leftJoin('users as u', 'u.id', '=', 'ob.ob_allocated_by')
            ->get();

        return view('staff.budget.management-view', compact('data', 'history'));
    }
}