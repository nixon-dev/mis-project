<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Models\Document;
use App\Models\History;
use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index()
    {

        $assignedOffice = Auth::user()->office_id;
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;

        $thisMonthDocumentCount = Document::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('document_origin', $assignedOffice)
            ->count();
        $lastMonthDocumentCount = Document::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->where('document_origin', $assignedOffice)
            ->count();
        return view('staff.index', compact('thisMonthDocumentCount', 'lastMonthDocumentCount'));
    }


    public function view_document($id)
    {
        $assigned_office = Auth::user()->office_id;
        $data = Document::where('document_number', $id)
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->first();

        if ($data->document_origin != $assigned_office) {
            return redirect(url('/staff/document-tracking'))->with('error', "Error: You don't have permission to view this document.");
        }

        if (!$data) {
            return redirect(url('/staff/document-tracking'))->with('error', 'Error: No Document Found');
        }

        $action = History::where('document_id', $data->document_id)->get();

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

        return view('staff.view-document', compact('data', 'action'));
    }

    public function document_tracking()
    {
        $assigned_office = Auth::user()->office_id;
        $office = Office::orderBy('office_name', 'ASC')->get();
        $data = Document::where('document_origin', $assigned_office)
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->orderBy('created_at', 'DESC')
            ->get();

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

        foreach ($data as $d) {
            $d->document_deadline = Carbon::parse($d->document_deadline)->format('M d, Y h:i A');
        }
        return view('staff.document', compact('data', 'office', 'documentId'));
    }

    public function insert_document(Request $request)
    {
        $request->validate([
            'document_title' => 'required|string',
            'document_origin' => 'required|numeric',
        ]);

        $query = Document::insert([
            'document_title' => $request->input('document_title'),
            'document_origin' => $request->input('document_origin'),
            'document_nature' => $request->input('document_nature'),
            'document_number' => $request->input('document_number'),
            'document_deadline' => $request->input('document_deadline'),
        ]);

        if ($query) {
            return redirect(url('/staff/document-tracking'))->with('success', 'Add data successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert document');
        }
    }

    public function delete_document($id)
    {

        $query = Document::where('document_id', $id)->delete();

        if ($query) {
            return redirect(url('/staff/document-tracking'))->with('success', 'Document deleted successfully!');
        } else {
            return redirect()->back() - with('error', 'Error: Failed to delete document.');
        }
    }

    public function insert_document_action(Request $request)
    {


        $request->validate([
            'document_id' => 'required|numeric',
            'history_name' => 'required|string|max:255',
            'history_date' => 'required|date',
            'history_action' => 'required|string',
        ]);

        $query = History::insert([
            'document_id' => $request->input('document_id'),
            'dh_name' => $request->input('history_name'),
            'dh_date' => $request->input('history_date'),
            'dh_action' => $request->input('history_action'),
        ]);

        if ($query) {
            return redirect()->back()->with('success', 'Action added successfull!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert action');
        }
    }

    public function settings()
    {
        return view('staff.settings');
    }

    public function user_update(Request $request)
    {

        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
        ]);

        $query = User::where('id', $request->id)->update(['name' => $request->name]);

        if ($query) {
            return redirect()->back()->with('success', 'Personal Information updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Update Failed');
        }
    }

    public function document_update(Request $request)
    {
        $request->validate([
            'document_id' => 'required|numeric',
            'document_title' => 'required',
            'document_nature' => 'required',
            'amount' => 'required|numeric',
        ]);

        $query = Document::where('document_id', $request->document_id)
            ->update([
                'document_title' => $request->document_title,
                'document_nature' => $request->document_nature,
                'amount' => $request->amount,
                'document_deadline' => $request->document_deadline,
            ]);

        if ($query) {
            return redirect()->back()->with('success', 'Document updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to update document.');
        }
    }

    public function document_update_status(Request $request)
    {
        try {


            $allowedColumns = ['pr', 'canvass', 'abstract', 'obr', 'po', 'par', 'air', 'dv'];
            $columnName = $request->input('item_column');

            if (!in_array($columnName, $allowedColumns)) {
                return response()->json(['success' => false, 'message' => 'Invalid column name'], 400);
            }

            Document::where('document_id', $request->document_id)
                ->update([$columnName => $request->item_status]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
