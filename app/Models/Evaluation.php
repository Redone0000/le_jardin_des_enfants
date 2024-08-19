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
}
