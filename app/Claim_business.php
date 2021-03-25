<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim_business extends Model
{
	protected $table = 'claim_business';

	protected $fillable = ['claim_user_id', 'business_id', 'business_creator_id', 'approval_status'];

	/**
	* Get the user that owns the phone.
	*/
	public function claimuser()
	{
		return $this->belongsTo('App\User', 'claim_user_id', 'id');
	}

	public function creator()
	{
		return $this->belongsTo('App\User', 'business_creator_id', 'id');
	}

	public function business()
	{
		return $this->belongsTo('App\Business', 'business_id', 'id');
	}
}
