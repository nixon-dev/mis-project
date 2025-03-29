<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\History;
use App\Models\Items;
use App\Traits\RecordHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DocumentController extends Controller
{
    use RecordHistory;

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
        ]);

        $document_title = Document::where('document_id', $request->document_id)->first()->document_title;
        $this->recordHistory('Added Items for', $document_title);

        if ($query) {
            return redirect()->back()->with('success', 'Item added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to add item.');
        }



    }
}