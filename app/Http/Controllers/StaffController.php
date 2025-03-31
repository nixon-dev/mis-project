<?php

namespace App\Http\Controllers;

use App\Models\Attachmments;
use App\Models\Items;
use Hash;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Models\Document;
use App\Models\History;
use App\Models\Office;
use App\Models\PendingDocx;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\RecordHistory;

class StaffController extends Controller
{
    use RecordHistory;

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

        $office = Office::where('office_id', $assignedOffice)->first();

        $data = Document::selectRaw("date_format(created_at, '%Y-%m') as month, count(*) as aggregate")
            ->whereDate('created_at', '>=', now()->subMonth(12))
            ->where('document_origin', $assignedOffice)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $date = \Carbon\Carbon::parse($item->month . '-01');
                $item->month = $date->format('F');
                return $item;
            });

        return view('staff.index', compact('thisMonthDocumentCount', 'lastMonthDocumentCount', 'data', 'office'));
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
        
        return view('staff.view-document', compact('data', 'action', 'items', 'attachments', 'checkIfSent'));
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

    public function document_pending()
    {
        $assigned_office = Auth::user()->office_id;
        $office = Office::orderBy('office_name', 'ASC')->get();
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Pending')
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
        return view('staff.document.pending', compact('data', 'office', 'documentId'));
    }

    public function document_approved()
    {
        $assigned_office = Auth::user()->office_id;
        $office = Office::orderBy('office_name', 'ASC')->get();
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Approved')
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
        return view('staff.document.approved', compact('data', 'office', 'documentId'));
    }

    public function document_denied()
    {
        $assigned_office = Auth::user()->office_id;
        $office = Office::orderBy('office_name', 'ASC')->get();
        $data = Document::where('document_origin', $assigned_office)
            ->where('document_status', 'Denied')
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
        return view('staff.document.denied', compact('data', 'office', 'documentId'));
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
}
