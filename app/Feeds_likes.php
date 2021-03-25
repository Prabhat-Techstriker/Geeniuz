<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeds_likes extends Model
{
	protected $table = 'feeds_likes';

	protected $fillable = ['feeds_id', 'user_id', 'likes' , 'dislikes'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }
}
