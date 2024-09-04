<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDay extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'date', 'meal'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
