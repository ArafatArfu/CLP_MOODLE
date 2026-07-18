<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    public $fillable = [
        'first_name',
        'last_name',
        'address_one',
        'address_two',
        'city',
        'state',
        'zip',
        'country',
        'email',
        'phone',
        'message',
        'examplecheck',
        'example'
    ];
}
