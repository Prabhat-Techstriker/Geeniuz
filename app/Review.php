<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $table = 'reviews';

	protected $fillable = ['user_id', 'business_id', 'rating', 'review'];

	public function review_images()
	{
		return $this->hasMany('App\Review_images');
	}

	public function Business() {
        return $this->belongsTo('App\Business', 'business_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
