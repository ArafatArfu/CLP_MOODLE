<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'countries';

    protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'name'
    ];

    public static function getRules($id = null)
    {
        return [
            'name' => 'required|unique:countries,name,' . $id . '|max:255',
        ];
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'country_id');
    }
}
