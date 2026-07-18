<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'address_one',
        'city',
        'address_two',
        'state',
        'country',
        'email',
        'zip',
        'phone',
        'instituition',
        'location',
        'contact',
        'phone2',
        'donateBy',
        'memory',
        'instruction'
    ];
}
