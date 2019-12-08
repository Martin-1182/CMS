<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [

         'image', 'album_id'

         ];

    public function image() 
   
    {
      return $this->belongsTo('App\Album');
    }
}
