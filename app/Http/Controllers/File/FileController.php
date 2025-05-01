<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Attachmments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{


    public function fileUpload(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();

                $allowedExtensions = ['pdf', 'doc', 'docx'];

                if (!in_array(strtolower($extension), $allowedExtensions)) {
                    return response()->json(['error' => 'Invalid file type. Only PDF, DOC, and DOCX are allowed.'], 400);
                }

                $sanitizedFileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $originalFileName);
                $fileName = $sanitizedFileName . '_' . time() . '.' . $extension;
                $file->storeAs('files', $fileName, 'public');

                Attachmments::insert([
                    'document_id' => $request->document_id,
                    'da_name' => $fileName,
                    'da_file_type' => $extension,
                ]);

                return response()->json(['success' => $fileName]);
            } else {
                return response()->json(['error' => 'No file provided.'], 400);
            }
        } catch (Exception $e) {
            return response("Error: " . $e->getMessage(), 500);
        }
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