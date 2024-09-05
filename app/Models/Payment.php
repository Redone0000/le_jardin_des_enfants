<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'stripe_payment_id',
        'amount',
        'currency',
        'status',
    ];

    /**
     * Relation avec le modèle Reservation.
     * Un paiement appartient à une réservation.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
