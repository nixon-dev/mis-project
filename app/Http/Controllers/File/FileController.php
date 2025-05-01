<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Exception;
use Illuminate\Http\Request;
use App\Models\Attachmments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

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
                $office = Office::where('office_id', Auth::user()->office_id)->first();
                if (!$office || !$office->office_name) {
                    return response()->json(['error' => 'Invalid office.'], 400);
                }

                $officeName = Office::where('office_id', Auth::user()->office_id)->first()->office_name;

                $abbreviation = implode('', array_map(function ($word) {
                    return isset($word[0]) ? strtoupper($word[0]) : '';
                }, preg_split('/\s+/', $officeName)));


                $storagePath = 'files/' . $abbreviation . '/';

                $sanitizedFileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $originalFileName);
                $fileName = $sanitizedFileName . '_' . time() . '.' . $extension;
                $file->storeAs($storagePath, $fileName, 'public');


                Attachmments::insert([
                    'document_id' => $request->document_id,
                    'da_name' => $fileName,
                    'da_folder' => $abbreviation,
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


    public function fileDownload($folder, $filename)
    {

        $filePath = 'files/' . $folder . '/' . $filename;
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($filePath, $filename);

    }

    public function fileDelete($folder, $filename)
    {

        $role = Auth::user()->role;

        if ($role == 'Administrator' || $role == 'Staff') {
            $filePath = 'files/' . $folder . '/' . $filename;

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

    public function file_view($folder, $filename)
    {
        $filePath = 'files/' . $folder . '/' . $filename;
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->route('external.pending')->with('error', 'File does not exist.');
        }

        $fileUrl = Storage::disk('public')->download($filePath, $filename);

        return view('staff.external.view-pdf', compact('fileUrl', 'filename'));
    }


}