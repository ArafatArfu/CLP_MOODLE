<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'cities';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'state_id'
    ];

    public static function getRules($id = null)
    {
        return [
            'name' => 'required|unique:cities,name,' . $id . '|max:255',
            'state_id' => 'required',
        ];
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'state_id', 'id');
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'cities_id', 'id');
    }

}
