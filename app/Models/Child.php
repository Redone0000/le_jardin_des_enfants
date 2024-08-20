<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'lastname',
        'firstname',
        'type',
        'sexe',
        'birth_date',
        'picture',
        'tutor_id',
    ];

    public function classe()
    {
        return $this->belongsTo(ClassSection::class, 'class_id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }

    public function scopeFilterByUserRole($query)
    {
        $user = auth()->user();

        if ($user->role_id === 1) {
            // Pour l'administrateur, afficher tous les enfants
            return $query;
        } elseif ($user->role_id === 2) {
            // Pour l'enseignant, afficher uniquement les enfants de sa classe
            return $query->where('class_id', $user->teacher->classSection->id);
        } elseif ($user->role_id === 3) {
            // Pour le tuteur, afficher uniquement les enfants dont il est le tuteur


            return $query->whereIn('class_id', function ($query) use ($user) {
                $query->select('class_id')
                    ->from('children')
                    ->where('tutor_id', $user->tutor->id);
            });
        } else {
            // Si le rôle de l'utilisateur n'est pas défini, retourner une collection vide
            return $query->where('id', 0);
        }
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'child_id');
    }
}
