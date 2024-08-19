<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id',
        'activity_type_id',
        'title',
        'description',
    ];

    /**
     * Get the class that owns the activity.
     */
    public function class()
    {
        return $this->belongsTo(ClassSection::class, 'class_id');
    }

    /**
     * Get the type activity that owns the activity.
     */
    public function activitytype()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }

    /**
     * Get the type activity that owns the activity.
     */
    public function activityData()
    {
        return $this->hasMany(activityData::class, 'activity_id');
    }

    /**
     * Scope a query to only include activities relevant to the given user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $user)
    {
        if ($user->role->name === 'admin') {
            return $query;
        }

        if ($user->role->name === 'teacher') {
            return $query->where('class_id', $user->teacher->classSection->id);
        }

        if ($user->role->name === 'tutor') {
            $classIds = $user->tutor->children->pluck('class_id')->toArray();
            return $query->whereIn('class_id', $classIds);
        }

        return $query->where('class_id', 0);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

}
