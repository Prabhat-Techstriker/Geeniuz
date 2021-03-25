<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review_images extends Model
{
    protected $table = 'review_images';

    protected $fillable = ['review_id', 'user_id', 'image'];
}
