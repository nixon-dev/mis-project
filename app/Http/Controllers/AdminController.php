<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Attachmments;
use App\Models\PendingDocx;
use App\Models\Sessions;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Document;
use App\Models\History;
use App\Models\Office;
use App\Models\User;
use App\Models\Items;
use App\Models\Units;
use Illuminate\Database\QueryException;
use App\Traits\RecordHistory;
use Illuminate\Support\Facades\Storage;
use Session;


class AdminController extends Controller
{
    use RecordHistory;

    public function index()
    {

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;


        $thisMonthDocumentCount = Document::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $lastMonthDocumentCount = Document::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $pendingCount = Document::where('document_status', 'Pending')
            ->count();

        $approvedCount = Document::where('document_status', 'Approved')
            ->count();

        $deniedCount = Document::where('document_status', 'Denied')
            ->count();

        $documents = Document::orderBy('created_at', 'DESC')->take(5)->get();


        $userCount = User::where('role', '!=', 'Guest')->count();
        $activeUserCount = Sessions::where('last_activity', '>', Carbon::now()->subMinute(10)->getTimestamp())->count();

        $data = Document::selectRaw("date_format(created_at, '%Y-%m') as month, count(*) as aggregate")
            ->whereDate('created_at', '>=', now()->subMonth(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $date = \Carbon\Carbon::parse($item->month . '-01');
                $item->month = $date->format('F');
                return $item;
            });

        $activeUsers = Sessions::where('last_activity', '>', Carbon::now()->subMinute(10)->getTimestamp())
            ->leftJoin('users', 'users.id', '=', 'sessions.user_id')
            ->orderBy('last_activity', 'desc')
            ->get();


        $logs = ActivityLog::orderBy('created_at', 'DESC')->take(10)->get();


        return view('admin.index', compact('thisMonthDocumentCount', 'lastMonthDocumentCount', 'userCount', 'activeUserCount', 'logs', 'data', 'pendingCount', 'deniedCount', 'approvedCount', 'documents', 'activeUsers'));
    }


    public function view_document($id)
    {
        $data = Document::where('document_number', $id)
            ->leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->first();

        if (!$data) {
            return redirect(url('/admin/document-tracking'))->with('error', 'Error: No Document Found');
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



        return view('admin.view-document', compact('data', 'action', 'items', 'attachments', 'checkIfSent', 'pendingDocx'));
    }

    public function document_tracking()
    {
        $office = Office::orderBy('office_name', 'ASC')->get();

        $data = Document::leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->select('document.*', 'office.office_name')
            ->orderBy('created_at', 'DESC')
            ->get();


        foreach ($data as $d) {
            $d->document_deadline = Carbon::parse($d->document_deadline)->format('M d, Y h:i A');
        }
        return view('admin.document', compact('data', 'office'));
    }





    public function users_list()
    {
        $users = User::where('role', '!=', 'Guest')->leftJoin('office', 'office.office_id', '=', 'users.office_id')
            ->select('users.*', 'office.office_name')
            ->get();
        return view('admin.users', compact('users'));
    }

    public function pending_users_list()
    {
        $users = User::where('role', '=', 'Guest')
            ->leftJoin('office', 'office.office_id', '=', 'users.office_id')
            ->select('users.*', 'office.office_name')
            ->get();
        return view('admin.pending-users', compact('users'));
    }

    public function view_users($id)
    {
        $info = User::where('id', $id)
            ->leftJoin('office', 'office.office_id', '=', 'users.office_id')
            ->select('users.*', 'office.office_name')
            ->get();
        $office = Office::get();

        if ($info->isNotEmpty()) {
            return view('admin.view-user', compact('info', 'office'));
        } else {
            return redirect(url('/admin/users'))->with('error', 'Error: User not found');
        }
    }

    public function user_settings()
    {
        return view('admin.user-settings');
    }

    public function users_update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'role' => 'required|string',
        ]);

        $query = User::where('id', $request->id)->update(['role' => $request->role, 'office_id' => $request->office_id]);

        if ($query) {
            return redirect()->back()->with('success', 'User has been updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to update user.');
        }
    }

    public function user_update(Request $request)
    {

        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
        ]);

        $query = User::where('id', $request->id)->update(['name' => $request->name]);

        if ($query) {
            return redirect()->back()->with('success', 'Personal information updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Update Failed');
        }
    }

    public function office()
    {
        $office = Office::orderBy('office_name', 'ASC')->get();

        return view('admin.office', compact('office'));
    }

    public function office_delete($id)
    {
        try {
            $query = Office::where('office_id', $id)->delete();
            if ($query) {
                return redirect()->back()->with('success', 'Office deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Error: Failed to delete office');
            }
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->back()->with('error', 'Cannot delete this office because it is linked to other records.');
            }
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function office_add(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string',
        ]);

        $query = Office::insert([
            'office_name' => $request->input('office_name'),
        ]);

        if ($query) {
            return redirect()->back()->with('success', 'Office added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to add office');
        }
    }

    public function users_delete($id)
    {
        $query = User::where('id', $id)->delete();

        if ($query) {
            return redirect(url('/admin/users/'))->with('success', 'User has been deleted!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to Delete User');
        }
    }

    public function history(Request $request)
    {


        $activities = ActivityLog::orderBy('created_at', 'desc')->get();


        return view('admin.history', compact('activities'));
    }

    public function active_users()
    {

        $activeUsers = Sessions::where('last_activity', '>', Carbon::now()->subMinute(10)->getTimestamp())
            ->leftJoin('users', 'users.id', '=', 'sessions.user_id')
            ->orderBy('last_activity', 'desc')
            ->get();

        return view('admin.active-users', compact('activeUsers'));
    }

    public function settings()
    {

        return view('admin.settings.index');
    }

    public function units()
    {

        $units = Units::orderBy('unit_name', 'ASC')->get();

        return view('admin.units', compact('units'));
    }

    public function units_delete($id)
    {

        $query  = Units::where('unit_id', $id)->delete();

        if ($query) {
            return back()->with('success', 'Unit deleted successfully!');
        } else {
            return back()->with('error', 'Error: Failed to delete unit.');
        }
    }

    public function units_add(Request $request)
    {
        $request->validate([
            'unit_name' => 'required|string',
        ]);

        $query = Units::insert([
            'unit_name' => $request->unit_name,
        ]);

        if ($query) {
            return back()->with('success','Unit added successfully!');
        } else {
            return back()->with('error', 'Error: Failed to add unit.');
        }
    }
}
