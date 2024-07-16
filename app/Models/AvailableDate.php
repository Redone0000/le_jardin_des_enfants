<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AvailableDate extends Model
{
    use HasFactory;

    protected $fillable = ['date'];

    public $timestamps = false;

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }
}
