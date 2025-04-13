<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Attachmments;
use App\Models\Co;
use App\Models\Document;
use App\Models\ExternalDocx;
use App\Models\History;
use App\Models\Items;
use App\Models\Mooe;
use App\Models\Office;
use App\Models\ResCenter;
use App\Models\Units;
use App\Traits\RecordHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    use RecordHistory;

    public function add(Request $request)
    {
        $request->validate([
            'document_title' => 'required|string',
        ]);

        $today = Carbon::now()->format('ymd');
        $prefix = $today . '-';

        $latestId = Document::where('document_number', 'like', $prefix . '%')
            ->max('document_number');

        if ($latestId) {
            $lastCount = (int) substr($latestId, strlen($prefix));
            $newCount = $lastCount + 1;
        } else {
            $newCount = 1;
        }
        $formattedCount = str_pad($newCount, 5, '0', STR_PAD_LEFT);

        $documentId = $prefix . $formattedCount;

        $assignedOffice = Auth::user()->office_id;

        $query = Document::insert([
            'document_title' => $request->document_title,
            'document_origin' => $assignedOffice,
            'document_nature' => $request->document_nature,
            'document_number' => $documentId,
            'document_deadline' => $request->document_deadline,
            'rc_code' => $request->rc_code,
        ]);

        $this->recordHistory('Inserted Document', $request->document_title);



        if ($query) {
            return redirect()->back()->with('success', 'Add data successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert document');
        }
    }

    public function view($id)
    {
        $assigned_office = Auth::user()->office_id;
        $data = Document::where('document_number', $id)
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->first();

        if (!$data) {
            return back()->with('error', 'Error: No Document Found');
        }

        if ($data->document_origin != $assigned_office) {
            return back()->with('error', "Error: You don't have permission to view this document.");
        }

        $action = History::where('document_id', $data->document_id)->get();
        $items = Items::where('document_id', $data->document_id)->get();
        $attachments = Attachmments::where('document_id', $data->document_id)->get();

        foreach ($action as $a) {
            $a->dh_date = Carbon::parse($a->dh_date)->format('M d, Y - h:i A');
        }

        if ($data->document_deadline === NULL) {
            $data->document_deadline = "No Deadline";
        } else {
            $unformatted_deadline = Carbon::parse($data->document_deadline);
            $data->document_deadline = $unformatted_deadline->format('M d, Y - h:i A');
            $data->unformatted_document_deadline = $unformatted_deadline->format('Y-m-d H:i');
        }

        $pendingDocx = ExternalDocx::where('document_id', $data->document_id)->first();

        $checkIfSent = ExternalDocx::where('document_id', $data->document_id)->count();

        $units = Units::get();

        $mooes = Mooe::orderBy('name', 'ASC')->get();

        $co = Co::orderBy('name', 'ASC')->get();

        return view('staff.document.view', compact('data', 'action', 'items', 'attachments', 'checkIfSent', 'pendingDocx', 'units', 'mooes', 'co'));
    }


    public function draft()
    {
        $assigned_office = Auth::user()->office_id;
        $officeName = Office::where('office_id', $assigned_office)->first()->office_name;
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Draft')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->orderBy('created_at', 'DESC')
            ->get();

        $rescen = ResCenter::orderBy('name', 'ASC')->get();

        foreach ($data as $d) {
            $d->document_deadline = Carbon::parse($d->document_deadline)->format('M d, Y h:i A');
        }
        return view('staff.document.draft', compact('data', 'officeName', 'rescen'));
    }

    public function pending()
    {
        $assigned_office = Auth::user()->office_id;
        $officeName = Office::where('office_id', $assigned_office)->first()->office_name;
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Pending')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->orderBy('created_at', 'DESC')
            ->get();

        $rescen = ResCenter::orderBy('name', 'ASC')->get();

        foreach ($data as $d) {
            $d->document_deadline = Carbon::parse($d->document_deadline)->format('M d, Y h:i A');
        }
        return view('staff.document.pending', compact('data', 'officeName', 'rescen'));
    }

    public function approved()
    {
        $assigned_office = Auth::user()->office_id;
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Approved')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->orderBy('created_at', 'DESC')
            ->get();

        $officeName = Office::where('office_id', $assigned_office)->first()->office_name;

        $rescen = ResCenter::orderBy('name', 'ASC')->get();
        foreach ($data as $d) {
            $d->document_deadline = Carbon::parse($d->document_deadline)->format('M d, Y h:i A');
        }
        return view('staff.document.approved', compact('data', 'officeName', 'rescen'));
    }

    public function denied()
    {
        $assigned_office = Auth::user()->office_id;
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Denied')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($data as $d) {
            $d->document_deadline = Carbon::parse($d->document_deadline)->format('M d, Y h:i A');
        }
        return view('staff.document.denied', compact('data'));
    }

    public function add_item(Request $request)
    {

        $request->validate([
            'document_id' => 'required|numeric',
            'item_unit' => 'required|string',
            'item_description' => 'required|string',
            'item_quantity' => 'required|numeric',
        ]);

        $query = Items::insert([
            'document_id' => $request->document_id,
            'di_unit' => $request->item_unit,
            'di_description' => $request->item_description,
            'di_quantity' => $request->item_quantity,
            'di_mooe' => $request->item_mooe,
        ]);

        $document_title = Document::where('document_id', $request->document_id)->first()->document_title;
        $this->recordHistory('Added Items', $document_title);

        if ($query) {
            return redirect()->back()->with('success', 'Item added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to add item.');
        }
    }
}