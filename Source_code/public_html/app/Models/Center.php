<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'state_id',
        'cities_id',
        'schools_id'
    ];

    public static function getRules($id = null)
    {
        return [
            'country_id' => 'required',
            'state_id' => 'required',
            'cities_id' => 'required',
            'schools_id' => 'required',
        ];
    }

    public function division(){
        return $this->hasOne(Division::class,'id', 'country_id');
    }
    public function district(){
        return $this->hasOne(District::class,'id', 'state_id');
    }
    public function upazila(){
        return $this->hasOne(Upazila::class,'id', 'cities_id');
    }
    public function school(){
        return $this->hasOne(School::class,'id', 'schools_id');
    }
}
