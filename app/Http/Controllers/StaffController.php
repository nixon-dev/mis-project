<?php

namespace App\Http\Controllers;

use App\Models\Attachmments;
use App\Models\Co;
use App\Models\ExternalDocx;
use App\Models\Items;
use App\Models\Notifications;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Document;
use App\Models\History;
use App\Models\Mooe;
use App\Models\Office;
use App\Models\PendingDocx;
use App\Models\ResCenter;
use App\Models\Units;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\RecordHistory;

use function PHPUnit\Framework\isEmpty;

class StaffController extends Controller
{
    use RecordHistory;

    public function index()
    {

        $assignedOffice = Auth::user()->office_id;
        $budgetOfficeId = Settings::where('id', 1)->first()->budget_office;

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;


        $thisMonthDocumentCount = Document::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('document_origin', $assignedOffice)
            ->count();

        $lastMonthDocumentCount = Document::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->where('document_origin', $assignedOffice)
            ->count();

        $pendingCount = Document::where('document_origin', $assignedOffice)
            ->where('document_status', 'Pending')
            ->count();

        $approvedCount = Document::where('document_origin', $assignedOffice)
            ->where('document_status', 'Approved')
            ->count();

        $deniedCount = Document::where('document_origin', $assignedOffice)
            ->where('document_status', 'Denied')
            ->count();

        $totalBudget = Document::where('document_origin', $assignedOffice)
            ->where('document_status', 'Approved')
            ->sum('amount');

        $thisMonthBudget = Document::where('document_origin', $assignedOffice)
            ->where('document_status', 'Approved')
            ->whereMonth('created_at', $currentMonth)
            ->sum('amount');

        $pendingDocxCount = PendingDocx::where('dp_status', 'Pending')->count();

        $office = Office::where('office_id', $assignedOffice)->first();

        $notifications = Notifications::leftJoin('document', 'document.document_id', '=', 'notifications.document_id')
            ->leftJoin('users', 'users.id', '=', 'notifications.created_by')
            ->where('document.document_origin', $assignedOffice)
            ->where('read_at', null)
            ->select('document.*', 'notifications.*', 'users.*', 'notifications.created_at as notif_created_at', 'notifications.id as notif_id')
            ->orderBy('notif_created_at', 'DESC')
            ->take(10)->get();

        $officeName = Office::where('office_id', $assignedOffice)->first()->office_name;

        $documents = Document::where('document_origin', $assignedOffice)->orderBy('created_at', 'DESC')->take(5)->get();

        $data = Document::selectRaw("date_format(created_at, '%Y-%m') as month, count(*) as aggregate")
            ->whereDate('created_at', '>=', now()->subMonth(12))
            ->where('document_origin', $assignedOffice)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $date = Carbon::parse($item->month . '-01');
                $item->month = $date->format('F');
                return $item;
            });

        return view('staff.index', compact('data', 'budgetOfficeId', 'office', 'notifications', 'pendingCount', 'deniedCount', 'approvedCount', 'officeName', 'thisMonthDocumentCount', 'lastMonthDocumentCount', 'documents', 'totalBudget', 'thisMonthBudget', 'pendingDocxCount'));
    }




    public function settings()
    {
        return view('staff.settings.account');
    }

    public function user_update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
        ]);

        $query = User::where('id', $request->id)->update(['name' => $request->name]);

        if ($query) {
            return response()->json([
                'success' => true,
                'message' => 'Personal information updated successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Update Failed',
            ]);
        }
    }

    public function notifications()
    {
        @$assignedOffice = Auth::user()->office_id;
        $notifications = Notifications::leftJoin('document', 'document.document_id', '=', 'notifications.document_id')
            ->leftJoin('users', 'users.id', '=', 'notifications.created_by')
            ->where('document.document_origin', $assignedOffice)
            ->where('read_at', null)
            ->select('document.*', 'notifications.*', 'users.*', 'notifications.created_at as notif_created_at', 'notifications.id as notif_id')
            ->orderBy('notif_created_at', 'DESC')
            ->take(10)->get();

        return view('staff.notifications', compact('notifications'));
    }


}