<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBudgetOffice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $budgetOfficeId = Settings::where('id', 1)->value('budget_office');

        if ($user && $user->office_id == $budgetOfficeId) {
            return $next($request);

        }

        return redirect()->route('staff.index')->with('error', 'Access Denied');
    }
}