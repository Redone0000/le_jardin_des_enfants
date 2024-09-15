<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'teacher_id',
        'section_id',
        'school_year',
    ];

    public $timestamps = false;

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function children()
    {
        return $this->hasMany(Child::class, 'class_id');
    }

    /**
     * Get the activities for the class.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'class_id');
    }
}
