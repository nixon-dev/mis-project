<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function add_document_form()
    {
        $office = DB::table('office')->get();
        return view('pages/add-document', compact('office'));
    }
}