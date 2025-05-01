<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Notifications;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;


class ApiController extends Controller
{
    public function mark_read($id)
    {
        $query = Notifications::where('id', $id)->update([
            'read_at' => now(),
        ]);

        return back();

    }

    public function view_notif($id, $number)
    {
        $query = Notifications::where('id', $id)
            ->update([
                'read_at' => now(),
            ]);

        if ($query) {
            return redirect()->route('document.view', ['id' => $number]);
        } else {
            return back()->with('error', 'Notification not found');
        }


    }

    public function download_pdf($filename)
    {

        // $filePath = 'pdf/' . $filename;
        // if (!Storage::disk('public')->exists($filePath)) {
        //     abort(404, 'File not found');
        // }

        // return Storage::disk('public')->download($filePath, $filename);

        return response()->file(storage_path('app/public/pdf/' . $filename), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);


    }

    public function view_pdf($filename)
    {
        try {
            $filePath = 'files/' . $filename;

            if (!Storage::disk('public')->exists($filePath)) {
                abort(404, 'File not found');
            }

            $fullPath = storage_path('app/public/' . $filePath);

            $phpWord = IOFactory::load($fullPath);
            $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
            $htmlContent = '';
            ob_start();
            $htmlWriter->save('php://output');
            $htmlContent = ob_get_contents();
            ob_end_clean();

            $pdf = SnappyPdf::loadHTML($htmlContent);

            // Return the PDF (you can choose to stream or download)
            return $pdf->stream('document.pdf');

        } catch (Exception $e) {
            return response("Error:" . $e->getMessage(), 500);
        }
    }
}