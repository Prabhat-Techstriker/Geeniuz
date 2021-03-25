<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pushnotification extends Model
{
	public $table = 'pushnotification';

	protected $fillable = [
		'message',
		'user_id'
	];
}
