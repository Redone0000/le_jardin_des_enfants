<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Liste des attributs assignables en masse
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'event_date',
    ];

    // protected $dates = [
    //     'event_date',
    // ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir les données associées à l'événement.
     */
    public function eventData()
    {
        return $this->hasMany(EventData::class);
    }
}
