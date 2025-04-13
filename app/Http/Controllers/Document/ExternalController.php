<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Attachmments;
use App\Models\Document;
use App\Models\ExternalDocx;
use App\Models\History;
use App\Models\Items;
use App\Models\Notifications;
use App\Models\Office;
use App\Traits\RecordHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ExternalController extends Controller
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
            ->orderBy('dp_created_at', 'ASC')
            ->get();

        return view('staff.external.pending', compact('data'));
    }

    public function approved()
    {
        $assignedOffice = Auth::user()->office_id;

        $data = ExternalDocx::where('de_status', 'Approved')
            ->where('document_external.office_id', $assignedOffice)
            ->leftJoin('document', 'document.document_id', '=', 'document_external.document_id')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document_external.*', 'office.*', 'document.*', 'document_external.created_at as dp_created_at')
            ->orderBy('dp_created_at', 'ASC')
            ->get();

        return view('staff.external.approved', compact('data'));
    }

    public function denied()
    {
        $assignedOffice = Auth::user()->office_id;
        $data = ExternalDocx::where('de_status', 'Denied')
            ->where('document_external.office_id', $assignedOffice)
            ->leftJoin('document', 'document.document_id', '=', 'document_external.document_id')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document_external.*', 'office.*', 'document.*', 'document_external.created_at as dp_created_at')
            ->orderBy('dp_created_at', 'ASC')
            ->get();

        return view('staff.external.denied', compact('data'));
    }

    public function view($id)
    {

        $assignedOffice = Auth::user()->office_id;


        $data = Document::where('document_number', $id)
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->first();

        if (!$data) {
            return redirect()->route('external.pending')->with('error', 'No Document Found');
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


        return view('staff.external.view', compact('data', 'action', 'items', 'attachments', 'externalDocx', 'office'));
    }
    public function add_action(Request $request)
    {


        $query = History::insert([
            'document_id' => $request->input('document_id'),
            'dh_name' => Auth::user()->name,
            'dh_date' => now(),
            'dh_action' => $request->action . ' Document',
        ]);

        if ($query) {
            $document_title = Document::where('document_id', $request->input('document_id'))->first()->document_title;
            $this->recordHistory('Inserted Action for', $document_title);

            $assignedOffice = Auth::user()->office_id;

            ExternalDocx::where('document_id', $request->document_id)
                ->where('document_external.office_id', $assignedOffice)
                ->update([
                    'de_status' => $request->action,
                    'de_remarks' => $request->remarks,
                ]);


            Notifications::insert([
                'document_id' => $request->document_id,
                'type' => $request->action,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Action added successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to insert action');
        }
    }
}