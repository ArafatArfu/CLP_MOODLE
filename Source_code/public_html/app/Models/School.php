<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;

    protected $table = 'schools';

    protected $guarded = ['id'];

    protected $fillable = [
        'school_name',
        'cities_id',
    ];

    public static function getRules($id = null)
    {
        return [
            'school_name' => 'required|unique:schools,school_name,' . $id . '|max:255',
            'cities_id' => 'required',
        ];
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'cities_id', 'id');
    }

    public function schoolInfo()
    {
        return $this->hasOne(Schoolinfo::class, 'schools_id', 'id');
    }
}
