<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessTiming;
use App\Business_awards;
use App\Business_images;
use App\Feeds;
use App\Review;
use App\Save_user_businesses;
use App\User;
use Illuminate\Http\Request;

class BusinessController extends Controller {
	public function __construct() {
		$this->middleware('auth:api');
	}

	public function show(Request $request) {
		$businesses = Business::getRecords($request->all());
		return response()->json(['status' => 'success', 'businesses' => $businesses, 'message' => 'Fetched all businesses.'], 200);
	}

	public function create(Request $request) {
		$uid = $request->user();
		$request->validate([
			'name' => 'required|string',
			'phone' => 'required|string|unique:businesses',
			'email' => 'required|email|unique:businesses',
			'cat_id' => 'required|integer',
			'subcat_id' => 'required|integer',
			'address' => 'required|string',
			'latitude' => 'required|numeric',
			'logitude' => 'required|numeric',
			'opening_hours' => 'required|string',
			'closing_hours' => 'required|string',
			'opening_day' => 'required|string',
			'closing_day' => 'required|string',
			'services_description' => 'required|string',
			/*'fb_link' => 'string|url',
			'ig_link' => 'string|url',
			'twitter_link' => 'string|url',*/
			'add_promotions' => 'string',
			//'web_link' => 'string|url',
			'dm' => 'required|bool',
			'phone_call' => 'required|bool',
			'home_delivery' => 'required|bool',
			'price_category' => 'required|integer',
		]);

		try {
			// $records = $request->except('opening_hours', 'closing_hours', 'opening_day', 'closing_day');
			$records = $request->except('image');
			
			// $records['user_id'] = $uid['id'];
			$records['user_id'] = 0;
			$business = Business::create($records);

			if ($image = $request->file('image')) {
				foreach ($image as $files) {
					$filenameWithExt = $files->getClientOriginalName();
					$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
					$extension = $files->getClientOriginalExtension();
					$mimeType = $files->getClientMimeType();
					$fileNameToStore = str_replace(" ", "-", $filename) . '_' . time() . '.' . $extension;
					//$path = $image->storeAs('images', $fileNameToStore);
					$path = $files->move(public_path() . '/business/', $fileNameToStore);
					$img_upload = Business_images::create([
						'business_id' => $business->id,
						'user_id' => $records['user_id'],
						'image' => '/business/' . $fileNameToStore,
					]);
				}
			}

			$hourStartday = BusinessTiming::flipedWeek($request['opening_day']);
			$hourEndday = BusinessTiming::flipedWeek($request['closing_day']);
			foreach (BusinessTiming::Week_DAYS as $key => $weekDay) {
				$active = 0;
				if ($hourStartday <= $key && $hourEndday >= $key) {
					$active = 1;
				}

				BusinessTiming::create([
					'business_id' => $business->id,
					'opening_timing' => $request['opening_hours'],
					'closing_timing' => $request['closing_hours'],
					'days' => $key,
					'active' => $active,
				]);
			}
			if ($request->input('subcat_id') > 0) {
				$business->categories()->attach([$request->input('cat_id'), $request->input('subcat_id')]);
			}

			$business = Business::with('businessTimings')->where(['id' => $business->id])->first();
			return response()->json(['success' => true, 'business' => $business, 'message' => 'Business has been listed.'], 201);
		} catch (\Exception $e) {
			print_r($e);
			return response()->json(['success' => false, 'message' => 'Failed to create business.'], 409);
		}
	}

	public function detail(Request $request, $id) {
		$uid = $request->user()->id;
		try {
			$detail = Business::with('images', 'businessTimings')->findOrFail($id);
			$detail = ($detail) ? $detail->toArray() : '';
			$reviews = Review::with('review_images', 'user')->where(['business_id' => $id, 'user_id' => $uid])->get();
			$reviews = ($reviews) ? $reviews->toArray() : '';
			$detail['reviews'] = $reviews;
			$countRecomm = Feeds::where(['businesses_id' => $id, 'type_of_feed' => 2])->count();
			$countChkins = Feeds::where(['businesses_id' => $id, 'type_of_feed' => 1])->count();
			$detail['countRecomm'] = $countRecomm;
			$detail['countChkins'] = $countChkins;
			return response()->json(['status' => 'success', 'business' => $detail, 'message' => 'Business Detail Listing.'], 200);
		} catch (\Exception $e) {
			return response()->json(['status' => 'failed', "message" => "Business not found"], 404);
		}
	}

	public function businessRecommendation(Request $request) {

		try {
			$countRecomm = Feeds::where(['businesses_id' => $request->business_id, 'type_of_feed' => 2])->with('user')->get();

			return response()->json(['status' => 'success', 'business' => $countRecomm, 'message' => 'Business recommendation Listing.'], 200);
		} catch (\Exception $e) {
			return response()->json(['status' => 'failed', "message" => "recommendation not found"], 404);
		}
	}

	public function businessCheckIns(Request $request) {
		try {
			$countCheckins = Feeds::where(['businesses_id' => $request->business_id, 'type_of_feed' => 1])->with('user')->get();

			return response()->json(['status' => 'success', 'business' => $countCheckins, 'message' => 'Business checkins Listing.'], 200);
		} catch (\Exception $e) {

			return response()->json(['status' => 'failed', "message" => "checkins not found"], 404);
		}
	}

	public function delete($id) {
		try {
			$business = Business::find($id);
			$business->categories()->detach();
			$del_business = Business::where(['id' => $id])->delete();
			$business_awards = Business_awards::where(['business_id' => $id])->delete();
			$business_images = Business_images::where(['business_id' => $id])->delete();
			$businessTiming = BusinessTiming::where(['business_id' => $id])->delete();
			$feeds = Feeds::where(['businesses_id' => $id])->delete();
			$Review = Review::where(['business_id' => $id])->delete();
			$Save_user_businesses = Save_user_businesses::where(['business_id' => $id])->delete();

			return response()->json(['success' => true, 'message' => 'business has been deleted successfully!.'], 200);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to delete business.'], 409);
		}
	}

	public function update(Request $request) {
		$uid = $request->user();
		$request->validate([
			'business_id' => 'required|integer',
		]);
		/*$request->validate([
			'name' => 'required|string',
			'phone' => 'required|string',
			'email' => 'required|email',
			'cat_id' => 'required|integer',
			'subcat_id' => 'required|integer',
			'address' => 'required|string',
			'latitude' => 'required|numeric',
			'logitude' => 'required|numeric',
			'opening_hours' => 'required|string',
			'closing_hours' => 'required|string',
			'opening_day' => 'required|string',
			'closing_day' => 'required|string',
			'services_description' => 'required|string',
			'fb_link' => 'string|url',
			'ig_link' => 'string|url',
			'twitter_link' => 'string|url',
			'add_promotions' => 'string',
			'web_link' => 'string|url',
			'dm' => 'required|bool',
			'phone_call' => 'required|bool',
			'home_delivery' => 'required|bool',
			'price_category' => 'required|integer',
		]);*/

		try {
			//$businessData = Business::with('images')->where('id', $request->business_id)->first();
			$businessData = Business::with('images','businessTimings')->find($request->business_id);

			// $records = $request->except('opening_hours', 'closing_hours', 'opening_day', 'closing_day', 'image', 'business_id');
			$records = $request->except('image', 'business_id');
			$records['user_id'] = $uid['id'];

			$businessData->name 							= is_null($request->name) ? $businessData->name : $request->name;
			$businessData->address 							= is_null($request->address) ? $businessData->address : $request->address;
			$businessData->phone 							= is_null($request->phone) ? $businessData->phone : $request->phone;
			$businessData->email 							= is_null($request->email) ? $businessData->email : $request->email;
			$businessData->latitude 						= is_null($request->latitude) ? $businessData->latitude : $request->latitude;
			$businessData->logitude 						= is_null($request->logitude) ? $businessData->logitude : $request->logitude;
			$businessData->services_description 			= is_null($request->services_description) ? $businessData->services_description : $request->services_description;
			$businessData->fb_link 							= is_null($request->fb_link) ? $businessData->fb_link : $request->fb_link;
			$businessData->ig_link 							= is_null($request->ig_link) ? $businessData->ig_link : $request->ig_link;
			$businessData->twitter_link 					= is_null($request->twitter_link) ? $businessData->twitter_link : $request->twitter_link;
			$businessData->add_promotions 					= is_null($request->add_promotions) ? $businessData->add_promotions : $request->add_promotions;
			$businessData->web_link 						= is_null($request->web_link) ? $businessData->web_link : $request->web_link;
			$businessData->dm 								= is_null($request->dm) ? $businessData->dm : $request->dm;
			$businessData->phone_call 						= is_null($request->phone_call) ? $businessData->phone_call : $request->phone_call;
			$businessData->home_delivery 					= is_null($request->home_delivery) ? $businessData->home_delivery : $request->home_delivery;
			$businessData->price_category 					= is_null($request->price_category) ? $businessData->price_category : $request->price_category;
			$businessData->opening_hours 					= is_null($request->opening_hours) ? $businessData->opening_hours : $request->opening_hours;
			$businessData->closing_hours 					= is_null($request->closing_hours) ? $businessData->closing_hours : $request->closing_hours;
			$businessData->opening_day 						= is_null($request->opening_day) ? $businessData->opening_day : $request->opening_day;
			$businessData->closing_day 						= is_null($request->closing_day) ? $businessData->closing_day : $request->closing_day;
			
			$businessData->save();

			//$update = Business::where(['id' => $request->business_id])->update($records);

			if ($image = $request->file('image')) {
				Business_images::where(['business_id'=>$request->business_id , 'user_id' => $uid->id])->delete();
				foreach ($image as $files) {
					$filenameWithExt = $files->getClientOriginalName();
					$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
					$extension = $files->getClientOriginalExtension();
					$mimeType = $files->getClientMimeType();
					$fileNameToStore = str_replace(" ", "-", $filename) . '_' . time() . '.' . $extension;
					//$path = $image->storeAs('images', $fileNameToStore);
					$path = $files->move(public_path() . '/business/', $fileNameToStore);
					$img_upload = Business_images::create([
						'business_id' => $request->business_id,
						'user_id' => $uid->id,
						'image' => '/business/' . $fileNameToStore,
					]);
				}
			}

			//$img_upload = BusinessTiming::where(['business_id' => $request->business_id])->delete();
			$timingData = BusinessTiming::where(['business_id' => $request->business_id])->pluck('id');
			$time = 0;
			if (isset($request['opening_day']) && isset($request['closing_day'])) {
				$hourStartday = BusinessTiming::flipedWeek($request['opening_day']);
				$hourEndday = BusinessTiming::flipedWeek($request['closing_day']);
				foreach (BusinessTiming::Week_DAYS as $key => $weekDay) {
					$active = 0;
					if ($hourStartday <= $key && $hourEndday >= $key) {
						$active = 1;
					}

					BusinessTiming::where(['business_id' => $request->business_id, 'id' => $timingData[$time]])->update([
						'opening_timing' => $request['opening_hours'],
						'closing_timing' => $request['closing_hours'],
						'days' => $key,
						'active' => $active,
					]);

					$time++;
				}
			} 
			/*if($request->input('subcat_id') > 0) {
				$business->categories()->attach([$request->input('cat_id'), $request->input('subcat_id')]);
			*/
			$business_Data = Business::with('images','businessTimings')->where('id', $request->business_id)->first();
			return response()->json(['success' => true, 'business' => $business_Data, 'message' => 'Business has been updated.'], 200);
		} catch (\Exception $e) {
			print_r($e);
			return response()->json(['success' => false, 'message' => 'Failed to create business.'], 409);
		}

	}

	public function imageRemove(Request $request) {
		try {
			$img_data = Business_images::where(['id' => $request->image_id])->first();
			unlink(public_path() . $img_data->image);
			$img_upload = Business_images::where(['id' => $request->image_id])->delete();

			return response()->json(['success' => true, 'message' => 'image deleted.'], 200);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to delete image.'], 409);
		}
	}
}
