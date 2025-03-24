<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Auth;


trait RecordHistory
{
    /**
     * Store an action in the history table.
     *
     * @param string $action
     * @param string|null $description
     * @return void
     */
    
     protected function recordHistory(string $action, ?string $description = null): void
     {
 
         ActivityLog::insert([
             'history_name' => Auth::user()->name,
             'history_action' => $action,
             'history_description' => $description,
             'created_at' => now(),
             'updated_at' => now(),
         ]);
     }
}
