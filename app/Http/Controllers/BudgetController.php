<?php

namespace App\Http\Controllers;

use App\Models\Attachmments;
use App\Models\Document;
use App\Models\History;
use App\Models\Items;
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
            ->get();


        return view("staff.budget.pending", compact("data"));
    }

    public function submit($id)
    {

        $query = PendingDocx::insert([
            'document_id' => $id,
        ]);

        if ($query) {
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

        return view('staff.budget.view', compact('data', 'action', 'items', 'attachments', 'checkIfSent'));
    }

    public function reload_table($id)
    {
        $action = History::where('document_id', $id)->get();
        return response()->json($action);
    }
}
