<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\History;
use App\Models\Items;
use App\Traits\RecordHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    use RecordHistory;

    public function insert_document(Request $request)
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
            'rc_code' => $request->rc_code,
        ]);

        $this->recordHistory('Inserted Document', $request->document_title);


        if ($query) {
            return redirect()->back()->with('success', 'Add data successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert document');
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
                return redirect(url('/staff/document-tracking'))->with('success', 'Document deleted successfully!');
            } elseif ($role === 'Administrator') {
                return redirect(url('/admin/document-tracking'))->with('success', 'Document deleted successfully!');
            }
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
            return redirect()->back()->with('success', 'Action added successfull!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to insert action');
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

    public function document_insert_item(Request $request)
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