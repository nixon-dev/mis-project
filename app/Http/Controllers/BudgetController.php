<?php

namespace App\Http\Controllers;

use App\Models\Attachmments;
use App\Models\Document;
use App\Models\History;
use App\Models\Items;
use App\Models\Notifications;
use App\Models\PendingDocx;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function pending()
    {

        $data = PendingDocx::where('dp_status', 'Pending')
            ->leftJoin('document', 'document.document_id', '=', 'document_pending.document_id')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document_pending.*', 'office.*', 'document.*', 'document_pending.created_at as dp_created_at')
            ->orderBy('dp_created_at', 'ASC')
            ->get();


        return view("staff.budget.pending", compact("data"));
    }

    public function submit($id)
    {

        $query = PendingDocx::insert([
            'document_id' => $id,
        ]);


        if ($query) {
            Document::where('document_id', $id)->update(['document_status' => 'Pending']);

            return redirect()->back()->with('success', 'Document submitted successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to submit document');
        }
    }

    public function view($id)
    {

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

        $checkIfSent = PendingDocx::where('document_id', $data->document_id)->count();

        $pendingDocx = PendingDocx::where('document_id', $data->document_id)->first();


        return view('staff.budget.view', compact('data', 'action', 'items', 'attachments', 'checkIfSent', 'pendingDocx'));
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

        $query = PendingDocx::where('document_id', $request->document_id)
            ->update([
                'dp_status' => $request->review_action,
                'dp_remarks' => $request->review_remarks,
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


            return redirect()->back()->with('success', 'Document action taken successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to take action');
        }

    }
}