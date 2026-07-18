<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schoolinfo extends Model
{
    protected $fillable = [
        'schools_id',
        'clc',
        'school_name',
        'start_date',
        'support',
        'scr',
        'ds',
        'csaw',
        'mail',
        'history',
        'contact_phone',
        'sponsor_name',
        'accomplish',
        'hardware',
        'plaquefile',
        'plaquefile1',
        'plaquefile2',
        'photofile',
        'photofile1',
        'photofile2',
        'school_des',
        'school_youtube',
        'link_slag',
        'status',
        'project',
        'img'
    ];

    public static function getRules($id = null)
    {
        return [
            'schools_id' => 'required',
            'clc' => 'required',
            'start_date' => 'required',
            'support' => 'nullable',
            'mail' => 'nullable',
            'history' => 'nullable',
            'contact_phone' => 'nullable',
            'sponsor_name' => 'nullable',
            'accomplish' => 'nullable',
            'scr' => 'nullable',
            'ds' => 'nullable',
            'csaw' => 'nullable',
            'hardware' => 'nullable',
            'plaquefile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500',
            'plaquefile1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500',
            'plaquefile2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500',
            'photofile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500',
            'photofile1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500',
            'photofile2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'schools_id', 'id');
    }
}

