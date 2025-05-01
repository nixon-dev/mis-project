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

    public function documents()
    {
        $assignedOffice = Auth::user()->office_id;
        $data = ExternalDocx::where('document_external.office_id', $assignedOffice)
            ->leftJoin('document', 'document.document_id', '=', 'document_external.document_id')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document_external.*', 'office.*', 'document.*', 'document_external.created_at as dp_created_at')
            ->orderByDesc('dp_created_at', 'DESC')
            ->get();

        return view('staff.external.document', compact('data'));
    }


    public function pending()
    {
        $assignedOffice = Auth::user()->office_id;
        $data = ExternalDocx::where('de_status', 'Pending')
            ->where('document_external.office_id', $assignedOffice)
            ->leftJoin('document', 'document.document_id', '=', 'document_external.document_id')
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document_external.*', 'office.*', 'document.*', 'document_external.created_at as dp_created_at')
            ->orderByDesc('dp_created_at', 'DESC')
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
            ->orderBy('dp_created_at', 'DESC')
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
            ->orderBy('dp_created_at', 'DESC')
            ->get();

        return view('staff.external.denied', compact('data'));
    }

    public function view($id)
    {

        $assignedOffice = Auth::user()->office_id;


        $data = Document::where('document_number', $id)
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.*')
            ->first();

        if (!$data) {
            return redirect()->route('external.pending')->with('error', 'No Document Found');
        }

        
        if (!ExternalDocx::where('document_id', $data->document_id)->where('office_id', $assignedOffice)->exists()) {
            return redirect()->route('external.document')->with('error', 'You are not authorized to view this document.');
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

            $assignedOffice = Auth::user()->office_id;

            if ($request->action == 'Approved') {
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

            } elseif ($request->action == 'Denied') {
                ExternalDocx::where('document_id', $request->document_id)
                    ->where('document_external.office_id', $assignedOffice)
                    ->delete();

                Document::where('document_id', $request->document_id)
                    ->update([
                        'document_status' => $request->action,
                    ]);

                Notifications::insert([
                    'document_id' => $request->document_id,
                    'type' => $request->action,
                    'remarks' => $request->remarks,
                    'created_by' => Auth::user()->id,
                ]);

                return redirect()->route('external.document')->with('success', 'Document has been denied successfully!');
            }




        } else {
            return redirect()->back()->with('error', 'Failed to insert action');
        }
    }

    public function forward(Request $request)
    {
        $check = ExternalDocx::where('document_id', $request->document_id)
            ->where('office_id', $request->office_id)
            ->where('from_office', Auth::user()->office_id)
            ->exists();

        if ($check) {
            return back()->with('error', 'Document already forwarded on that office');
        }

        $query = ExternalDocx::insert([
            'document_id' => $request->document_id,
            'office_id' => $request->office_id,
            'from_office' => Auth::user()->office_id,
        ]);

        $officeName = Office::where('office_id', $request->office_id)->first()->office_name;

        if ($query) {

            History::insert([
                'document_id' => $request->document_id,
                'dh_name' => Auth::user()->name,
                'dh_date' => now(),
                'dh_action' => 'Forwarded Document to ' . $officeName,
                'dh_remarks' => $request->remarks,
            ]);

            ExternalDocx::where('office_id', Auth::user()->office_id)
                ->where('document_id', $request->document_id)
                ->delete();

            return redirect()->route('external.document')->with('success', 'Document forwarded successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to forward document');
        }
    }
}