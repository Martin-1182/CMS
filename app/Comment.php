<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
  // The attributes that are mass assignable. Form Comment
 
            protected $fillable = [

              'text', 'post_id'

            ];


   public function user() 
   
   {
     return $this->belongsTo('App\User');
   }

   // Get post this comment belongs to.

   public function post() 
   
   {
     return $this->belongsTo('App\Post');
   }
}
