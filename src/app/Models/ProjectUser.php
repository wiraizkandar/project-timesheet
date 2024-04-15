<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProjectUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
    ];

    /**
     * Get the user associated with the ProjectUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class, 'project_user_id', 'id');
    }

    public function scopeUserProjects($query)
    {
        return $query->with([
            'project:project_name,id'
        ])->where('user_id', auth('user')->id());
    }
}
