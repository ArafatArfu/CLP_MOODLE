<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    use HasFactory;
    public $fillable = [
        'founds',
        'other',
        'first_name',
        'last_name',
        'address_one',
        'address_two',
        'city',
        'zip',
        'country',
        'email',
        'phone',
        'message',
        'examplecheck',
        'example'
    ];
}
