<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'states';

    protected $guarded = ['id'];

    protected $fillable = [
        'state_name',
        'country_id'
    ];

    public static function getRules($id = null)
    {
        return [
            'state_name' => 'required|unique:countries,name,' . $id . '|max:255',
            'country_id' => 'required',
        ];
    }

    public function country()
    {
        return $this->belongsTo(Division::class, 'country_id');
    }

    public function upazilla()
    {
        return $this->hasMany(Upazila::class, 'state_id', 'id');
    }
}
