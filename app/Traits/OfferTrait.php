<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait OfferTrait
{
    function SaveImage($photo, $folder)
    {
        //save photo
        //save photo in folder
        $file_extension = $photo->getclientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);
        return $file_name;
    }
}
