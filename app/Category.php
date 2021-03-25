<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

	protected $fillable = ['name', 'description', 'parent_id'];

	public function subcategories() {
		return $this->hasMany('App\Category', 'parent_id');
	}

	public function businesses() {
		return $this->belongsToMany('App\Business', 'businesses_categories');
	}
}
