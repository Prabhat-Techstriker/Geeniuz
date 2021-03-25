<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed_comment extends Model
{
    protected $table = 'feed_comment';

    protected $fillable = ['feeds_id', 'user_id', 'comment'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
