<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\ExternalDocx;
use App\Models\Office;
use App\Traits\RecordHistory;
use Illuminate\Http\Request;

use App\Models\Attachmments;
use App\Models\Document;
use App\Models\History;
use App\Models\Items;
use App\Models\Notifications;
use App\Models\PendingDocx;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
class BudgetController extends Controller
{
    use RecordHistory;

    public function pending()
    {
        $assignedOffice = Auth::user()->office_id;
        $data = ExternalDocx::where('de_status', 'Pending')
            ->where('document_external.office_id', $assignedOffice)
            ->leftJoin('document', 'document.document_id', '=', 'document_external.document_id')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document_external.*', 'office.*', 'document.*', 'document_external.created_at as dp_created_at')
            ->orderBy('dp_created_at', 'DESC')
            ->get();

        return view('staff.budget.pending', compact('data'));
    }

    public function approved()
    {
        $assignedOffice = Auth::user()->office_id;
        $data = ExternalDocx::where('de_status', 'Approved')
            ->where('document_external.office_id', $assignedOffice)
            ->leftJoin('document', 'document.document_id', '=', 'document_external.document_id')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document_external.*', 'office.*', 'document.*', 'document_external.created_at as dp_created_at')
            ->orderBy('dp_created_at', 'DESC')
            ->get();

        return view('staff.budget.approved', compact('data'));
    }

    public function denied()
    {
        $assignedOffice = Auth::user()->office_id;

        $data = ExternalDocx::where('de_status', 'Denied')
            ->where('document_external.office_id', $assignedOffice)
            ->leftJoin('document', 'document.document_id', '=', 'document_external.document_id')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document_external.*', 'office.*', 'document.*', 'document_external.created_at as dp_created_at')
            ->orderBy('dp_created_at', 'DESC')
            ->get();

        return view('staff.budget.denied', compact('data'));
    }

    public function view($id)
    {
        $assignedOffice = Auth::user()->office_id;

        $data = Document::where('document_number', $id)
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->first();

        if (!$data) {
            return redirect()->route('budget.pending')->with('error', 'Error: No Document Found');
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


        $externalDocx = ExternalDocx::where('document_id', $data->document_id)
            ->where('document_external.office_id', $assignedOffice)
            ->first();
        $office = Office::orderBy('office_name')->get();


        return view('staff.budget.view', compact('data', 'action', 'items', 'attachments', 'externalDocx', 'office'));
    }

    public function reload_table($id)
    {
        $action = History::where('document_id', $id)->get();
        return response()->json($action);
    }

    public function action(Request $request)
    {
        $request->validate([
            'document_id' => 'required|numeric',
            'review_action' => 'required|string',
        ]);

        $query = ExternalDocx::where('document_id', $request->document_id)
            ->update([
                'de_status' => $request->review_action,
                'de_remarks' => $request->review_remarks,
            ]);

        if ($query) {
            Document::where('document_id', $request->document_id)
                ->update([
                    'document_status' => $request->review_action
                ]);

            Notifications::insert([
                'document_id' => $request->document_id,
                'type' => $request->review_action,
                'remarks' => $request->review_remarks,
                'created_by' => Auth::user()->id,
            ]);

            History::insert([
                'document_id' => $request->document_id,
                'dh_name' => Auth::user()->name,
                'dh_date' => now(),
                'dh_action' => $request->review_action . ' Document',
            ]);




            return redirect()->back()->with('success', 'Document action taken successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to take action');
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
            'document_id' => $request->input('document_id'),
            'dh_name' => $request->input('history_name'),
            'dh_date' => $request->input('history_date'),
            'dh_action' => $request->input('history_action'),
        ]);


        $document_title = Document::where('document_id', $request->input('document_id'))->first()->document_title;
        $this->recordHistory('Inserted Action for', $document_title);

        if ($query) {
            return redirect()->back()->with('success', 'Action added successfull!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert action');
        }
    }

    public function forward(Request $request)
    {
        $query = ExternalDocx::insert([
            'document_id' => $request->document_id,
            'office_id' => $request->office_id,
        ]);

        $officeName = Office::where('office_id', $request->office_id)->first()->office_name;

        if ($query) {
            Document::where('document_id', $request->document_id)->update(['document_status' => 'Pending']);

            History::insert([
                'document_id' => $request->document_id,
                'dh_name' => Auth::user()->name,
                'dh_date' => now(),
                'dh_action' => 'Forwarded Document to ' . $officeName,
            ]);

            return redirect()->back()->with('success', 'Document forwarded successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to forward document');
        }
    }



}