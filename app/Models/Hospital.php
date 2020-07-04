<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = "hospitals";
    protected $fillable = ['id', 'name', 'adresse', 'price', 'countrie_id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];


    public function doctor()
    {
        return $this->hasMany('App\Models\Doctor', 'hospital_id', 'id');
    }
}
