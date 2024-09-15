<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'menu_id',
        'price',
        'status',
        'month',
    ];

    // Indiquer si les timestamps sont gérés par Eloquent
    public $timestamps = true;

    /**
     * Relation avec le modèle Child.
     * Une réservation appartient à un enfant.
     */
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    /**
     * Relation avec le modèle Menu.
     * Une réservation appartient à un menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Récupère toutes les réservations pour l'administrateur
     * et seulement celles liées aux enfants du tuteur.
     */
    public static function getReservationsForUserQuery($user)
    {
        // Si l'utilisateur est un administrateur, on récupère toutes les réservations
        if ($user->role_id === 1) {
            $reservations = Reservation::all();
        }

        // Si l'utilisateur est un tuteur, on récupère les réservations liées à ses enfants
        if ($user->role_id === 3) {
            $reservations = Reservation::whereHas('child', function ($query) use ($user) {
                $query->where('tutor_id', $user->tutor->id);
            })->get();
        }

        return $reservations;
    }

}
