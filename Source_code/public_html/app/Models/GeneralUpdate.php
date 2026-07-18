<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralUpdate extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'general_updates';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'total_clc_count',
        'total_scr_count',
        'total_supportedcenter_count',
        'clc_sponsorship_price',
        'scr_sponsorship_price',
        'tokai_sponsorship_price',
        'num_of_trained_teachers',
        'last_updated_time',
        'number_of_graduates',
        'female_percentage',
        'map',
        'districts'
    ];
}
