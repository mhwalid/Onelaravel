<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = "cients";
    protected $fillable = ['id', 'name'];
    public $timestamps = false;


    public function moulhanout()
    {
        return $this->hasOneThrough('App\Models\Moulhanouts', 'App\Models\Karnis', 'client_id', 'karni_id', 'id', 'id');
    }
}
