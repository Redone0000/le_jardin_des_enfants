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

    // public function scopeForUser($query, $user)
    // {
    //     if ($user->role_id === 1) {
    //         return $query; // L'administrateur voit toutes les classes
    //     } elseif ($user->role_id === 2) {
    //         return $query->where('teacher_id', $user->teacher->id); // Le professeur voit ses propres classes
    //     } elseif ($user->role_id === 3) {
    //         $childrenClasses = $user->tutor->children->pluck('class_section_id')->toArray();
    //         return $query->whereIn('id', $childrenClasses); // Le tuteur voit les classes de ses enfants
    //     } else {
    //         return $query->where('id', 0); // Utilisateur non autorisé (ne verra aucune classe)
    //     }
    // }

}
