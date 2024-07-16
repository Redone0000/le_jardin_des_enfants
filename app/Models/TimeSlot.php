<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = ['start_time', 'end_time', 'available_date_id', 'is_available'];
    public $timestamps = false;

    public function availableDate()
    {
        return $this->belongsTo(AvailableDate::class); // Chaque créneau appartient à une date
    }

    public function getFormattedStartTimeAttribute()
    {

        return Carbon::parse($this->start_time)->format('H:i');
    }

    public function getFormattedEndTimeAttribute()
    {
        return Carbon::parse($this->end_time)->format('H:i');
    }
}
