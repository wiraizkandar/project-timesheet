<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class Timesheet extends Model
{
    use HasFactory;


    protected $fillable = [
        'project_user_id',
        'date',
        'time_start',
        'time_end',
        'summary_of_work',
    ];

    /**
     * Get the user associated with the Timesheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectUser(): HasOne
    {
        return $this->hasOne(ProjectUser::class, 'id', 'project_user_id');
    }

    public function getDurationAttribute()
    {
        return (Carbon::parse($this->time_start))
            ->diff(Carbon::parse($this->time_end))
            ->format('%H Hours %I Minutes');
    }

    /**
     * Get list of authenticated user timesheets
     *
     * @param [type] $query
     * @return EloquentBuilder
     */
    public function scopeUserTimesheet($query)
    {
        return $query->with([
            'projectUser',
            'projectUser.project:project_name,id'
        ])->whereHas('projectUser', function ($q) {
            $q->where('user_id', auth('user')->id());
        });
    }
}
