<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_list extends Model
{
    protected $table = 'contact_list';

	protected $fillable = ['user_id', 'contact_id'];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function contactBusi() {
		return $this->belongsTo('App\User','contact_id');
	}

	public function businesses() {
		return $this->hasMany('App\Business', 'user_id' ,'contact_id');
	}

	public function businessTimings() {
		return $this->hasMany('App\BusinessTiming', 'business_id');
	}
}
