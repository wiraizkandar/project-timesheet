<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTimeSheetRequest;
use App\Http\Requests\EditTimeSheetRequest;
use App\Models\Project;
use App\Models\ProjectUser;
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
        $timesheets = Timesheet::UserTimesheet()
            ->orderBy('created_at', 'desc')
            ->simplePaginate(10);

        return view('user.timesheets', compact('timesheets'));
    }

    public function showCreateTimeSheet(): View
    {
        $userProjects = ProjectUser::UserProjects()->get();

        return view('user.create-timesheet', compact('userProjects'));
    }

    public function storeCreateTimeSheet(CreateTimeSheetRequest $request)
    {
        try {
            Timesheet::create([
                'project_user_id' => $request->project_user_id,
                'date' => $request->date,
                'time_start' => $request->start_time,
                'time_end' => $request->end_time,
                'summary_of_work' => $request->summary_of_work
            ]);

            return redirect()->route('user.timesheet')->with('success', 'Timesheet submitted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit timesheet');
        }
    }

    public function showEditTimesheet($id)
    {
        $timesheet = Timesheet::UserTimesheet()
            ->where('id', $id)
            ->firstOrFail();

        return view('user.edit-timesheet', compact('timesheet'));
    }

    public function storeEditTimeSheet(EditTimeSheetRequest $request, $id)
    {
        try {

            $timesheet = Timesheet::UserTimesheet()
                ->where('id', $id)
                ->firstOrFail();

            $timesheet->date = $request->date;
            $timesheet->time_start = $request->start_time;
            $timesheet->time_end = $request->end_time;
            $timesheet->summary_of_work = $request->summary_of_work;

            $timesheet->save();

            return redirect()->back()->with('success', 'Timesheet updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update selected timesheet');
        }
    }

    public function showDeleteTimesheet($id)
    {
        $timesheet = Timesheet::UserTimesheet()
            ->where('id', $id)
            ->firstOrFail();

        return view('user.delete-timesheet', compact('timesheet'));
    }

    public function deleteTimesheet($id)
    {
        try {

            $timesheet = Timesheet::find($id);

            $timesheet->delete();

            return redirect()->route('user.timesheet')->with('success', 'Timesheet deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete selected timesheet');
        }
    }
}
