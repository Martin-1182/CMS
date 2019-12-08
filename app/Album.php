<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    protected $fillable = [

        'title', 'text', 'image'

         ];

    public function images() 
   
    {
      return $this->hasMany('App\Image')->latest();
    }
}
