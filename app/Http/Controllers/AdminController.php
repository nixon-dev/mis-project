<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Sessions;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Models\History;
use App\Models\Office;
use App\Models\User;
use App\Models\Items;
use Illuminate\Database\QueryException;
use App\Traits\RecordHistory;
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

        $staffCount = User::where('role', 'Staff')->count();
        $adminCount = User::where('role', 'Administrator')->count();
        $activeUserCount = Sessions::where('last_activity', '>', Carbon::now()->subMinute(10)->getTimestamp())->count();

        return view('admin.index', compact('thisMonthDocumentCount', 'lastMonthDocumentCount', 'staffCount', 'adminCount', 'activeUserCount'));
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




        return view('admin.view-document', compact('data', 'action','items'));
    }

    public function document_tracking()
    {
        $office = Office::orderBy('office_name', 'ASC')->get();

        $data = Document::leftJoin('office', 'office.office_id', '=', 'document.document_origin')
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
        return view('admin.document', compact('data', 'office', 'documentId'));
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


        $this->recordHistory('Inserted Document', $request->document_title);



        if ($query) {
            return redirect(url('/admin/document-tracking'))->with('success', 'Data added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert document');
        }
    }

    public function delete_document($id)
    {

        $document_title = Document::where('document_id', $id)->first()->document_title;

        $query = Document::where('document_id', $id)->delete();

        $this->recordHistory('Deleted Document', $document_title);


        if ($query) {
            return redirect(url('/admin/document-tracking'))->with('success', 'Document deleted successfully!');
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

        $document_title = Document::where('document_id', $request->input('document_id'))->first()->document_title;
        $this->recordHistory('Inserted Action for', $document_title);


        if ($query) {
            return redirect()->back()->with('success', 'Action added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to add action');
        }
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

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
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
}
