<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Models\History;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\QueryException;


class AdminController extends Controller
{
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
        return view('admin.index', compact('thisMonthDocumentCount', 'lastMonthDocumentCount'));
    }


    public function view_document($id)
    {
        $data = Document::leftJoin('office', 'office.office_id', '=', 'document.document_origin')
            ->where('document_id', $id)
            ->get();
        $action = History::where('document_id', $id)->get();


        foreach ($action as $a) {
            $a->history_date = Carbon::parse($a->history_date)->format('M d, Y - h:i A');
        }

        foreach ($data as $d) {
            $d->document_deadline = Carbon::parse($d->document_deadline)->format('M d, Y');
        }

        return view('admin.view-document', compact('data', 'action'));
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

    public function insert_document(Request $request)
    {
        $request->validate([
            'document_title' => 'required|string|max:255',
            'document_origin' => 'required|numeric',
            'document_number' => 'required|numeric',
        ]);

        $query = Document::insert([
            'document_title' => $request->input('document_title'),
            'document_origin' => $request->input('document_origin'),
            'document_nature' => $request->input('document_nature'),
            'document_number' => $request->input('document_number'),
            'document_deadline' => $request->input('document_deadline'),
        ]);

        if ($query) {
            return redirect(url('/admin/document-tracking'))->with('success', 'Data added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert document');
        }
    }

    public function delete_document($id)
    {

        $query = Document::where('document_id', $id)->delete();

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
            'history_name' => $request->input('history_name'),
            'history_date' => $request->input('history_date'),
            'history_action' => $request->input('history_action'),
        ]);

        if ($query) {
            return redirect()->back()->with('success', 'Action added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to add action');
        }
    }

    public function users_list()
    {
        $users = DB::table('users')->get();
        return view('admin.users', compact('users'));
    }

    public function view_users($id)
    {
        $info = User::where('id', $id)->get();

        if ($info->isNotEmpty()) {
            return view('admin.view-user', compact('info'));
        } else {
            return redirect(url('/admin/users/'))->with('error', 'Error: User not found');
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

        $query = User::where('id', $request->id)->update(['role' => $request->role]);

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

    public function document_update_status(Request $request)
    {
        try {
           

            $allowedColumns = ['pr', 'canvass', 'abstract', 'obr', 'po', 'par', 'air', 'dv'];
            $columnName = $request->input('item_column');

            if (!in_array($columnName, $allowedColumns)) {
                return response()->json(['success' => false, 'message' => 'Invalid column name'], 400);
            }

            Document::where('document_id', $request->input('document_id'))
                ->update([$columnName => $request->input('item_status')]);

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
