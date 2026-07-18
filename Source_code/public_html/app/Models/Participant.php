<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name',
        'first_name',
        'mailing_address',
        'email',
        'contact_phone',
        'guests',
        'payment_method',
        'amount',
        'comment'
    ];
}
