<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moulhanouts extends Model
{
    protected $table = "molhanouts";
    protected $fillable = ['id', 'name', 'karni_id'];
    public $timestamps = false;
}
