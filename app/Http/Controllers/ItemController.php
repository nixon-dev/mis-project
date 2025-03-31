<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Items;
use Illuminate\Http\Request;
use App\Traits\RecordHistory;


class ItemController extends Controller
{
    use RecordHistory;

    public function add_item(Request $request)
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
        $this->recordHistory('Added Items', $document_title);

        if ($query) {
            return redirect()->back()->with('success', 'Item added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to add item.');
        }
    }
}
