<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communities extends Model
{
	protected $table = 'communities';

	protected $fillable = ['creator_id','name','image'];

	protected $hidden = ['pivot'];


	public function user() {
		return $this->belongsToMany('App\User', 'communities_users');
	}

	public function creator() {
		return $this->belongsTo('App\User', 'creator_id');
	}
}
