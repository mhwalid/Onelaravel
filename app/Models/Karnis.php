<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karnis extends Model
{
    protected $table = "karni";
    protected $fillable = ['id', 'name', 'client_id'];
    public $timestamps = false;
}
