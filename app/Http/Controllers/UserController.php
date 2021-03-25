<?php

namespace App\Http\Controllers;

use App\Business;
use App\Business_awards;
use App\Communities;
use App\Contact_list;
use App\Feeds;
use App\Feed_comment;
use App\Review;
use App\Save_user_businesses;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function allUsers() {
		return response()->json(['success' => true, 'users' => User::all(), 'message' => 'Users data found.'], 200);
	}

	public function singleUser($id) {
		try {
			$user = User::findOrFail($id);
			return response()->json(['success' => true, 'user' => $user, 'message' => 'User record found.'], 200);
		} catch (\Exception $e) {
			return response()->json(['success' => false, 'message' => 'user not found!'], 404);
		}
	}

	public function searchUser(Request $request) {

		$request->validate([
			'search' => 'required',
		]);

		try {
			$users = User::where('first_name', 'LIKE', '%' . $request->search . '%')
				->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
				->orWhere('email', 'LIKE', '%' . $request->search . '%')
				->orWhere('phone', 'LIKE', '%' . $request->search . '%')
				->get();

			if (count($users) > 0) {
				return response()->json(['success' => true, 'users' => $users, 'message' => 'User records found.'], 200);
			} else {
				return response()->json(['success' => false, 'message' => 'user not found!'], 404);
			}
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'user not found!'], 404);
		}
	}

	public function update(Request $request,$id) {
		$request->validate([
			//'phone' => 'unique:users',
			//'email' => 'email|unique:users',
		]);
		$uid = $request->user()->id;
		if (User::where('id', $id)->exists()) {
			$user = User::find($id);

			$user->first_name = is_null($request->first_name) ? $user->first_name : $request->first_name;
			$user->last_name = is_null($request->last_name) ? $user->last_name : $request->last_name;
			$user->email = is_null($request->email) ? $user->email : $request->email;
			$user->phone = is_null($request->phone) ? $user->phone : $request->phone;

			$user->save();
			return response()->json(['success' => true, 'user' => $user, "message" => "user updated successfully."], 201);
		} else {
			return response()->json(['success' => false, "message" => "Category not found"], 404);
		}
	}

	public function updateUser(Request $request) {

		$uid = $request->user()->id;
		
		if (User::where('id', $uid)->exists()) {
			$user = User::find($uid);
			$profile = $user->profile_pic;
			$storage_path = storage_path('app/');
			$fileExist = file_exists($storage_path . $profile);

			if (!empty($profile)) {
				if ($fileExist) {
					unlink($storage_path . $profile);
				}
			}

			$user->first_name = is_null($request->first_name) ? $user->first_name : $request->first_name;
			$user->last_name = is_null($request->last_name) ? $user->last_name : $request->last_name;
			//$user->email = is_null($request->email) ? $user->email : $request->email;
			$user->phone = is_null($request->phone) ? $user->phone : $request->phone;

			if ($image = $request->file('profile_pic')) {
				$filenameWithExt = $image->getClientOriginalName();
				$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
				$extension = $image->getClientOriginalExtension();
				$mimeType = $image->getClientMimeType();
				$fileNameToStore = str_replace(" ", "-", $filename) . '_' . time() . '.' . $extension;
				$path = $image->storeAs('profile', $fileNameToStore);
				$user->profile_pic = $path;
			}

			$user->save();
			return response()->json(['success' => true, 'user' => $user, "message" => "user updated successfully."], 201);
		} else {
			return response()->json(['success' => false, "message" => "Category not found"], 404);
		}
	}

	public function delete($id) {
		if (User::where('id', $id)->exists()) {
			$category = User::find($id);
			$category->delete();
			$comment_dlt = Feed_comment::where('user_id', $id)->delete();
			return response()->json(['success' => true, "message" => "user deleted"], 202);
		} else {
			return response()->json(['success' => false, "message" => "user not found"], 404);
		}
	}

	public function saveBusinesses(Request $request) {
		$uid = $request->user()->id;
		$request->validate([
			'businesses_id' => 'required',
		]);

		try {
			$businesses = Business::find($request->businesses_id);
			if ($businesses) {
				$data = array('business_id' => $businesses->id, 'user_id' => $uid);
				$result = Save_user_businesses::create($data);
			}
			return response()->json(['success' => true, 'businesses' => $result, 'message' => 'Business has been saved!.'], 201);
		} catch (Exception $e) {

			return response()->json(['success' => false, 'message' => 'Failed to save business.'], 409);
		}
	}

	public function listSavedbusiness(Request $request) {
		// $uid = $request->user()->id;
		$uid = $request->user_id;
		try {
			$result = Save_user_businesses::where('user_id', $uid)->with('businesses')->pluck('business_id')->toArray();
			$businesses_list = Business::with('images')->whereIn('id', $result)->get();
			return response()->json(['success' => true, 'businesses' => $businesses_list, 'message' => 'Savedbusiness has been fetched!.'], 201);
		} catch (Exception $e) {

			return response()->json(['success' => false, 'message' => 'Failed to fetched Savedbusiness.'], 409);
		}
	}

	public function reviewsList(Request $request) {
		// $uid = $request->user()->id;
		$user_id = $request->user_id;

		try {
			$result = Review::where('user_id', $user_id)->with('review_images', 'Business')->get();
			return response()->json(['success' => true, 'reviews' => $result, 'message' => 'reviews has been fetched!.'], 201);
		} catch (Exception $e) {

			return response()->json(['success' => false, 'message' => 'Failed to fetched reviews.'], 409);
		}
	}

	public function feedsList(Request $request) {
		$uid = $request->user_id;
        $data_array = array();
		$request->validate([
			'type_of_feed' => 'required',
		]);

		try {
            // $result = Feeds::where(['user_id' => $uid, 'type_of_feed' => $request->type_of_feed])->pluck('businesses_id');
			//$result = Feeds::where(['user_id' => $uid, 'type_of_feed' => $request->type_of_feed])->get();
			//$businesses_list = Business::with('images')->whereIn('id', $result)->get();

            $feeds = Feeds::with('user')->where(['user_id' => $uid, 'type_of_feed' => $request->type_of_feed])->get();
            foreach ($feeds as $key => $value) {
                $images = Business::with('images')->where('id', $value->businesses_id)->first();
                $value['businesses'] = $images;
                $data_array[] = $value;
            }

			return response()->json(['success' => true, 'businesses' => $data_array, 'message' => 'feeds has been fetched!.'], 201);
		} catch (Exception $e) {

			return response()->json(['success' => false, 'message' => 'Failed to fetched feeds.'], 409);
		}
	}

	public function postsList(Request $request) {
		$uid = $request->user_id;
		try {
			//$result = Feeds::where(['user_id'=>$uid])->get();
			$data_array = array();
			$feeds = Feeds::where('user_id', $uid)->with('user', 'businesses')->get();
			foreach ($feeds as $key => $value) {
				$var = checkLikedByMe($value['id'], $uid); //Checking likes on feeds from the function
				$value['liked_by_me'] = $var ? true : false;
				$data_array[] = $value;
			}
			return response()->json(['success' => true, 'feed' => $data_array, 'message' => 'posts has been fetched!.'], 201);
		} catch (Exception $e) {

			return response()->json(['success' => false, 'message' => 'Failed to fetched posts.'], 409);
		}
	}

	public function countsInprofile(Request $request) {
		$loginuid = $request->user()->id;
		$uid = $request->user_id;
		$arr = array();
		$CountofSavedBusinesses = Save_user_businesses::where('user_id', $uid)->with('businesses')->count();
		$Posts = Feeds::where('user_id', $uid)->count();
		$Recommendations = Feeds::where(['user_id' => $uid, 'type_of_feed' => 2])->count();
		$CheckIns = Feeds::where(['user_id' => $uid, 'type_of_feed' => 1])->count();
		$Reviews = Review::where('user_id', $uid)->count();
		$awards = Business::where('user_id', $uid)->pluck('id')->toArray();
		$awards_count = Business_awards::whereIn('business_id', $awards)->sum('awards');
		$Communities = Communities::where('creator_id', $uid)->count();
		$existincommunities = Communities::with('user')->get()->toArray();
		$followers = Contact_list::where('contact_id', $uid)->count();
		$arrayData = array();
		foreach ($existincommunities as $key => $val) {
			foreach ($val['user'] as $key1 => $val1) {
				$arrayData[] = $val1['id'];
			}
		}
		$counts = array_count_values($arrayData);

		if (array_key_exists($uid, $counts)) {
			$exist_in_total_community = $counts[$uid] + $Communities;
		} else {
			$exist_in_total_community = $Communities;
		}

		$arr['CountofSavedBusinesses'] = $CountofSavedBusinesses;
		$arr['Posts'] = $Posts;
		$arr['Recommendations'] = $Recommendations;
		$arr['CheckIns'] = $CheckIns;
		$arr['Reviews'] = $Reviews;
		$arr['Communities'] = $exist_in_total_community;
		$arr['Awards'] = (int) $awards_count;
		$arr['Followers'] = $followers;

		$var = followByMeProfile($uid, $loginuid);

		$arr['Followbyloginuser'] = $var;

		return response()->json(['success' => true, 'result' => $arr, 'message' => 'counts has been fetched!.'], 201);
	}

	public function existIncommunity(Request $request) {

		$uid = $request->user_id;

		$Communities = Communities::where('creator_id', $uid)->get()->toArray();
		$existincommunities = Communities::with('user')->get()->toArray();
		$arrayData = array();

		foreach ($existincommunities as $key => $val) {
			foreach ($val['user'] as $key1 => $val1) {
				unset($val['user']);
				if ($val1['id'] == $uid) {
					$arrayData[] = $val;
				}
			}
			if ($val['creator_id'] == $uid) {
				$arrayData[] = $val;
			}
		}

		return response()->json(['success' => true, 'communities' => $arrayData, 'message' => 'community has been fetched!.'], 201);
	}

	public function awardsList(Request $request) {

		$uid = $request->user_id;

		$businesses_list = Business::where('user_id', $uid)->pluck('id')->toArray();
		$busi_awards = Business_awards::whereIn('business_id', $businesses_list)->with('Business')->get();

		return response()->json(['success' => true, 'awards' => $busi_awards, 'message' => 'awards has been fetched!.'], 201);
	}

	public function listAllbusiness(Request $request) {
		$request->validate([
			'user_id' => 'required',
		]);

		$businesses_list = Business::with('images')->where('user_id', $request->user_id)->get();

		return response()->json(['success' => true, 'businesses' => $businesses_list, 'message' => 'businesses has been fetched!.'], 200);
	}

	public function push(Request $request){
		
		$token = 'dwK-tmh2Ry-nvypWJ-Prrg:APA91bErvGv117zaSuARviykSGXOD8Ryrp_e-aqJuZz_y46mya2sPbiWNQMyz2Nwb5gHl0wFGZ-AMMrdcOv1FA_XBsR18JARB_TT19bOHMSGHbeNtFXD01VFx1ObC2-nZ5OrIMT3nHxc';
		sendPushnotification($token,'title','Hello');
	}
}