<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_history(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');

        $query = ActivityLog::query();

        if ($search) {
            $query->where('history_name', 'like', "%{$search}%")
                ->orWhere('history_action', 'like', "%{$search}%");
        }

        $totalRecords = $query->count();
        $filteredRecords = $query->count();

        $activities = $query->offset($start)
            ->limit($length)
            ->get();

        $data = [];
        foreach ($activities as $activity) {
            $data[] = [
                $activity->history_id,
                $activity->history_name,
                $activity->history_action,
            ];
        }

        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }
}
