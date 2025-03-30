<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attachmments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{


    public function fileUpload(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'document_id' => 'required|integer',
        ]);

        $file = $request->file('file');
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        $sanitizedFileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $originalFileName);

        $fileName = $sanitizedFileName;
        // $sanitizedFileName = str_replace(['..', '/', '\\'], '', $sanitizedFileName);
        $fileName = $fileName . '_' . time() . '.' . $extension;

        $file->storeAs('files', $fileName, 'public');

        Attachmments::insert([
            'document_id' => $request->document_id,
            'da_name' => $fileName,
            'da_file_type' => $extension,
        ]);



        return response()->json(['success' => $fileName]);


    }

    public function fileDownload($filename)
    {

        $filePath = 'files/' . $filename;
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($filePath, $filename);

    }

    public function fileDelete($filename)
    {

        $role = Auth::user()->role;

        if ($role == 'Administrator' || $role == 'Staff') {
            $filePath = 'files/' . $filename;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);

                Attachmments::where('da_name', $filename)->delete();

                return redirect()->back()->with('success', 'Attachment deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Error: Failed to delete attachment');
            }
        } else {
            Auth::logout();
            return redirect(url('/login'))->with('error', 'Unauthorized Action');
        }

    }


}