<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $fillable = ['id', 'pdf', 'patient_id'];
    public $timestamps = false;
}
