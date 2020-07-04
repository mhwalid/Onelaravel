<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    protected $fillable = ['code', 'phone'];
    protected $hidden = ['user_id'];
    public $timestamps = false;


    #########################"realtions

    public function user()
    {

        return $this->belongsTo('App\User', 'user_id');
    }
}
