<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Save_user_businesses extends Model
{
	protected $table = 'save_user_businesses';

	protected $fillable = ['business_id','user_id'];

	public function businesses() {
		return $this->hasMany('App\Business', 'id');
	}
}
