<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'hour',
        'child_last_name',
        'child_first_name',
        'child_birth_date',
        'child_sex',
        'parent_last_name',
        'parent_first_name',
        'phone_number',
        'email',
        'token'
    ];
}
