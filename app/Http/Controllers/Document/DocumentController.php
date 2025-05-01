<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Attachmments;
use App\Models\Co;
use App\Models\Document;
use App\Models\ExternalDocx;
use App\Models\History;
use App\Models\Items;
use App\Models\Mooe;
use App\Models\Notifications;
use App\Models\Office;
use App\Models\ResCenter;
use App\Models\Settings;
use App\Models\Units;
use App\Traits\RecordHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
        ]);

        $this->recordHistory('Inserted Document', $request->document_title);



        if ($query) {
            return redirect()->route('document.draft')->with('success', 'Added Document successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to insert document');
        }
    }

    public function view($id)
    {
        $assigned_office = Auth::user()->office_id;
        $data = Document::where('document_number', $id)
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.*')
            ->first();

        if (!$data) {
            if (Auth::user()->role == 'Admin') {
                return redirect()->route('admin.index')->with('error', 'No Document Found');
            } else {
                return redirect()->route('staff.index')->with('error', 'No Document Found');
            }
        }

        if ($data->document_origin != $assigned_office) {
            return back()->with('error', "You are not authorized to view this document.");
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
        $office = Office::orderBy('office_name', 'ASC')->get();
        $defaultBudgetOffice = Settings::where('id', '1')->first()->budget_office;

        return view('staff.document.view', compact('data', 'action', 'items', 'attachments', 'checkIfSent', 'pendingDocx', 'units', 'mooes', 'co', 'office', 'defaultBudgetOffice'));
    }


    public function draft()
    {
        $assigned_office = Auth::user()->office_id;
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Draft')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->orderBy('created_at', 'DESC')
            ->get();


        $officeName = Office::where('office_id', $assigned_office)->first()->office_name;
        $officeCode = Office::where('office_id', $assigned_office)->first()->office_code;


        return view('staff.document.draft', compact('data', 'officeName', 'officeCode'));
    }

    public function pending()
    {
        $assigned_office = Auth::user()->office_id;
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Pending')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->orderBy('created_at', 'DESC')
            ->get();



        $officeName = Office::where('office_id', $assigned_office)->first()->office_name;
        $officeCode = Office::where('office_id', $assigned_office)->first()->office_code;


        return view('staff.document.pending', compact('data', 'officeName', 'officeCode'));
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
        $officeCode = Office::where('office_id', $assigned_office)->first()->office_code;

        return view('staff.document.approved', compact('data', 'officeName', 'officeCode'));
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

        return view('staff.document.denied', compact('data'));
    }

    public function submit(Request $request)
    {
        $query = ExternalDocx::insert([
            'document_id' => $request->document_id,
            'office_id' => $request->office_id,
            'from_office' => Auth::user()->office_id,
        ]);



        if ($query) {

            $officeName = Office::where('office_id', $request->office_id)->first()->office_name;

            History::insert([
                'document_id' => $request->document_id,
                'dh_name' => Auth::user()->name,
                'dh_date' => Carbon::now(),
                'dh_action' => 'Submitted documents to ' . $officeName,
            ]);

            Document::where('document_id', $request->document_id)->update(['document_status' => 'Pending']);

            return redirect()->back()->with('success', 'Document submitted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to submit document');
        }
    }

    public function delete_document($id)
    {
        $role = Auth::user()->role;

        $document_title = Document::where('document_id', $id)->first()->document_title;

        $query = Document::where('document_id', $id)->delete();

        $this->recordHistory('Deleted Document', $document_title);

        if ($query) {
            if ($role === 'Staff') {
                return redirect(url('/staff/draft'))->with('success', 'Document deleted successfully!');
            } elseif ($role === 'Administrator') {
                return redirect(url('/admin/document-tracking'))->with('success', 'Document deleted successfully!');
            }
        } else {
            return redirect()->back() - with('error', 'Error: Failed to delete document.');
        }
    }

    public function add_action(Request $request)
    {


        $request->validate([
            'document_id' => 'required|numeric',
            'history_name' => 'required|string|max:255',
            'history_date' => 'required|date',
            'history_action' => 'required|string',
        ]);

        $query = History::insert([
            'document_id' => $request->document_id,
            'dh_name' => $request->history_name,
            'dh_date' => $request->history_date,
            'dh_action' => $request->history_action,
            'dh_remarks' => $request->history_remarks,
        ]);




        if ($query) {
            $document_title = Document::where('document_id', $request->input('document_id'))->first()->document_title;
            $this->recordHistory('Inserted Action for', $document_title);

            return redirect()->back()->with('success', 'Action added successfull!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert action');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'document_id' => 'required|numeric',
            'document_title' => 'required',
            'document_nature' => 'required',
        ]);

        $query = Document::where('document_id', $request->document_id)
            ->update([
                'document_title' => $request->document_title,
                'document_nature' => $request->document_nature,
                'document_deadline' => $request->document_deadline,
            ]);

        $this->recordHistory('Updated', $request->document_title);

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

            $name = Auth::user()->name;
            $column = strtoupper($columnName);
            if ($request->item_status == 'true') {
                $action = 'Signed ' . $column;
            } else {
                $action = 'Unsigned ' . $column;
            }
            History::insert([
                'document_id' => $request->document_id,
                'dh_name' => $name,
                'dh_action' => $action,
            ]);


            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
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
            'di_unit_price' => $request->item_unit_price,
            'di_total_amount' => $request->item_total_amount,
            'di_mooe' => $request->item_mooe,
            'di_co' => $request->item_co,
        ]);

        $oldAmount = Document::where('document_id', $request->document_id)->first()->amount;

        $newAmount = $oldAmount + $request->item_total_amount;

        Document::where('document_id', $request->document_id)->update(['amount' => $newAmount]);

        $document_title = Document::where('document_id', $request->document_id)->first()->document_title;
        $this->recordHistory('Added Items for', $document_title);

        if ($query) {
            return redirect()->back()->with('success', 'Item added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to add item.');
        }
    }
}