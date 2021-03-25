<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact_list;

class ContactlistController extends Controller
{
	public function __construct() {
	    $this->middleware('auth:api');
	}

	public function Create(Request $request) {
		$uid = $request->user()->id;

		$request->validate([
			'contact_id' 	=> 'required',
			'event'			=> 'required'
		]);

		$insert  = array('contact_id' => $request->contact_id,'user_id' => $uid);

		$contctData = User::find($request->contact_id);
		$userData = User::find($uid);

		try {
			if ($request->event == 1) {
				$addContact = Contact_list::create($insert);

				$msg =  $userData->first_name.' follows you.';

				Pushcreate($contctData->id,$msg);
			
				sendPushnotification($contctData->device_token, 'Geeniuz' ,$msg);

				return response()->json(['status' => 'success','message' => 'added in contact list.'], 200);
			}elseif ($request->event == 2) {
				$addContact = Contact_list::where(['user_id' => $uid,'contact_id' => $request->contact_id])->delete();
				return response()->json(['status' => 'success','message' => 'removed from contact list.'], 200);
			}

		} catch (Exception $e) {
			return response()->json(['status' => 'error','message' => 'something went wrong!.'], 401);
		}
	}

	public function followerList(Request $request){
		$login_uid = $request->user()->id;
		$uid = $request->user_id;
		$var = followByMe($login_uid,$uid);
		return response()->json(['data' => $var,'message' => 'feteched all followers.'], 200);
	}

	public function contactBusiness(Request $request){
		$uid = $request->user()->id;

		$res = Contact_list::where(['user_id' => $uid])->with('businesses')->get();

		return response()->json(['data' => $res,'message' => 'feteched all followers.'], 200);
	}
}
