<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Notifications;
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

        try {
            $filePath = 'files/' . $filename;
            if (!Storage::disk('public')->exists($filePath)) {
                abort(404, 'File not found');
            }

            $fullPath = storage_path('app/public/' . $filePath);

            $phpWord = IOFactory::load($fullPath);


            Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
            Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));

            $pdfPath = storage_path('app/public/temp_' . pathinfo($filename, PATHINFO_FILENAME) . '.pdf');

            $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
            $pdfWriter->save($pdfPath);

            return response()->download($pdfPath)->deleteFileAfterSend(true);
        } catch (\Throwable $e) {
            return response("Error generating PDF: " . $e->getMessage(), 500);
        }

    }
}