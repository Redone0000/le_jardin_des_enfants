<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['month', 'price'];
    public $timestamps = true;

    /**
     * Relation avec le modèle MenuDay.
     * Un menu a plusieurs jours de menu.
     */
    public function menuDays()
    {
        return $this->hasMany(MenuDay::class);
    }
}
