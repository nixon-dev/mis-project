<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Notifications;
use Illuminate\Http\Request;

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
        }


    }
}