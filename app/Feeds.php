<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeds extends Model
{
    protected $table = 'feeds';

    protected $fillable = ['community_id', 'businesses_id', 'user_id', 'message' , 'likes' , 'dislikes' ,'type_of_feed'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function businesses()
    {
        return $this->belongsTo('App\Business');
    }

}
