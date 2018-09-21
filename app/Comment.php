<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   protected $table = 'comment';
   protected $fillable = ['name', 'comment','post_id',];
   public function comments()
   {
       return $this->belongsTo('App\Post'); //app\postに属す（１つ
   }
 
}

