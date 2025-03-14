<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function add_document()
    {
        $office = DB::table('office')->get();
        return view('admin.add-document', compact('office'));
    }

    public function view_document($id)
    {
        $data = DB::table('document')->where('document_id', $id)->get();
        $office = DB::table('office')->get();
        return view('admin.view-document', compact('office', 'data'));
    }

    public function document_tracking()
    {
        $office = DB::table('office')->get();
        $data = DB::table('document')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->get();
        return view('admin.document', compact('data', 'office'));
    }

    public function insert_document(Request $request)
    {
        $request->validate([
            'document_title' => 'required|string|max:255',
            'document_origin' => 'required|numeric|max:6',
            'document_nature' => 'required|string|max:255',
            'document_number' => 'required|numeric',
            'document_deadline' => 'required|date',
        ]);

        $query = DB::table('document')
            ->insert([
                'document_title' => $request->input('document_title'),
                'document_origin' => $request->input('document_origin'),
                'document_nature' => $request->input('document_nature'),
                'document_number' => $request->input('document_number'),
                'document_deadline' => $request->input('document_deadline'),
            ]);

        if ($query) {
            return redirect(url('/admin/document-tracking'))->with('success', 'Add data successful');
        } else {
            return redirect()->back()->with('error', 'Failed to insert document');
        }
    }
}
