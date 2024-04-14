<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\CarbonInterval;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total_minutes',
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

    /**
     * Get list of authenticated user timesheets
     *
     * @param [type] $query
     * @return EloquentBuilder
     */
    public function scopeUserTimesheets($query)
    {
        return $query->with([
            'projectUser',
            'projectUser.project:project_name,id'
        ])->whereHas('projectUser', function ($q) {
            $q->where('user_id', auth('user')->id());
        })->select([
            'id',
            'date',
            'total_minutes',
            'summary_of_work',
            'project_user_id'
        ]);
    }
}
