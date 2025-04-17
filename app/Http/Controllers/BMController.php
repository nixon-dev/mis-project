<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class BMController extends Controller
{
    public function budget_management()
    {

        $data = Office::orderBy('office_name', 'ASC')->get();

        return view('staff.budget.management', compact('data'));
    }
}