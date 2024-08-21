<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'activity_id',
        'child_id',
        'grade',
        'feedback',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public static function getEvaluationsForTutor($tutorId)
    {
        return self::whereHas('child', function ($query) use ($tutorId) {
            $query->where('tutor_id', $tutorId);
        })
        ->with('child', 'activity') // Inclure les relations nécessaires
        ->get()
        ->groupBy('activity_id');
    }
}
