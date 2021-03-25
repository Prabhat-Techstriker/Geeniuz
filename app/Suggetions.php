<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggetions extends Model
{
     protected $table = 'suggestions';

    protected $fillable = ['user_id', 'business_id' , 'subject', 'message'];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function businesses() {
		return $this->hasMany('App\Business', 'id' , 'business_id');
	}
}
