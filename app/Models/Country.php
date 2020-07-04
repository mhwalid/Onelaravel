<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";
    protected $fillable = ['name'];
    public $timestamps = false;


    public function doctor()
    {
        return $this->hasManyThrough('App\Models\Doctor', 'App\Models\Hospital', 'countrie_id', 'hospital_id', 'id', 'id');
    }

    public function hospital()
    {
        return $this->hasMany('App\Models\Hospital', 'countrie_id', 'id');
    }
}
