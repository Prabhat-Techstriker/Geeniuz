<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Business extends Model
{
	protected $table = 'businesses';

	protected $fillable = ['user_id', 'name', 'phone', 'email', 'cat_id', 'subcat_id', 'address', 'latitude', 'logitude', 'services_description', 'fb_link', 'ig_link', 'twitter_link', 'add_promotions', 'web_link', 'dm', 'phone_call', 'home_delivery', 'images' ,'price_category','opening_hours', 'closing_hours', 'opening_day', 'closing_day'];

	protected $hidden = ['pivot'];

	public static function getRecords($filters) {
		
		$query = Business::select('*');

		//$query = DB::table('businesses');
		
			foreach($filters as $key => $value){
			
				if($value == "" || $value === "false"){
					continue;
				}
		
				switch ($key) {
					case 'category':
						$query->where('cat_id', $value);
					break;
					case 'subcategory':
						$query->where('subcat_id', $value);
					break;
					case 'phone_call':
						$query->where('phone_call', $value);
					break;
					case 'delivery':
						$query->where('home_delivery', $value);
					break;
					case 'dm':
						$query->where('dm', $value);
					break;
					case 'price_category':
						$query->where('price_category', $value);
					break;
					case 'contacts':
						$res = Contact_list::where(['user_id' => $value])->get();
						$res = $res->pluck('contact_id');
						$query->whereIn('user_id', $res);
					break;
				}			
			}
		//return $query->orderBy('businesses.updated_at', 'DESC')->paginate(20);
		return $query->with('images','businessTimings')->get();
		
	}
	public function user() {
		return $this->belongsTo('App\User', 'id');
	}

	public function categories() {
		return $this->belongsToMany('App\Category', 'businesses_categories');
	}

	public function reviews() {
		return $this->hasMany('App\Review', 'business_id');
	}

	public function businessTimings() {
		return $this->hasMany('App\BusinessTiming', 'business_id');
	}

	public function images() {
		return $this->hasMany('App\Business_images', 'business_id');
	}
}
