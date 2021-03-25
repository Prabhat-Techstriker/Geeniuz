<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_images extends Model
{
    protected $table = 'business_images';

    protected $fillable = ['business_id', 'user_id', 'image'];
}
