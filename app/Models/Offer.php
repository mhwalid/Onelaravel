<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";
    protected $fillable = ['name_fr', 'photo', 'name_en', 'price', 'insert_at', 'cato_fr', 'cato_en', 'created_at', 'updated_at'];
    protected $hidden = ['insert_at'];
}
