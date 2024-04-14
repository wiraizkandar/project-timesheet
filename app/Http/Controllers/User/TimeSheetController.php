<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Timesheet;
use Illuminate\Contracts\View\View;

class TimeSheetController extends Controller
{
    /**
     * Display a listing of user's submitted timesheets.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $timesheets = Timesheet::UserTimesheets()
            ->orderBy('date', 'desc')
            ->simplePaginate(10);

        return view('user.timesheets', compact('timesheets'));
    }
}
