<?php

namespace App\Http\Controllers;

use App\Business;
use App\Business_awards;
use App\Communities;
use App\Feeds;
use App\Feeds_likes;
use App\Feed_comment;
use App\User;
use Illuminate\Http\Request;

class CommunitiesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		$uid = $request->user()->id;

		$request->validate([
			'name' => 'required|string|unique:communities',
		]);

		try {
			if ($request->image) {
				$filenameWithExt = $request->file('image')->getClientOriginalName();
				$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
				$extension = $request->file('image')->getClientOriginalExtension();
				$mimeType = $request->file('image')->getClientMimeType();
				$fileNameToStore = str_replace(" ", "-", $filename) . '_' . time() . '.' . $extension;
				$path = $request->file('image')->storeAs('images', $fileNameToStore);

				$user = array('name' => $request->name, 'creator_id' => $uid, 'image' => $path);
			} else {
				$user = array('name' => $request->name, 'creator_id' => $uid);
			}

			$community = Communities::create($user);
			$id = $community->id;
			$result = $community->user()->attach($request->users);
			$resultData = Communities::where('id', $id)->with('user')->get();

			$res = User::whereIn('id', $request->users)->pluck('device_token')->toArray();
			$message = 'Congrats!! You are added to a new ('.$community->name.') community)';
			sendPushnotification($res,'Geeniuz',$message);
			$pushInsertdata = array();
			foreach ($request->users as $key => $value) {
				Pushcreate($value,$message);
			}

			return response()->json(['success' => true, 'community' => $resultData, 'message' => 'Community has been created!.'], 201);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to create community.'], 409);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request) {
		//$communityList = Communities::with('user')->get();
		$communityList = Communities::with('user')->get();
		return response()->json(['status' => 'success', 'communities' => $communityList, 'message' => 'Fetched all communities.'], 200);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Request $request) {
		$uid = $request->user()->id;
		$request->validate([
			'community_id' => 'required',
		]);

		try {
			$data = Communities::where(['id' => $request->community_id, 'creator_id' => $uid])->first();
			if ($data) {
				$community = Communities::find($request->community_id);
				$push_data = $community->user->pluck('device_token')->toArray();
				$community->user()->detach();
				$community->delete();

				$msg = $community->name.' Community has been deleted.';

				foreach ($push_data as $key => $value) {
					Pushcreate($value,$msg);
				}

				sendPushnotification($push_data,'Geeniuz',$msg);

				return response()->json(['success' => true, 'feed' => $feed, 'message' => 'community has been deleted successfully!.'], 200);
			} else {
				return response()->json(['success' => false, 'message' => 'Failed to found community.'], 409);
			}
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to delete community.'], 409);
		}
	}

	public function addUsertocommunity(Request $request) {
		$uid = $request->user()->id;

		try {
			$data = Communities::where(['id' => $request->community_id, 'creator_id' => $uid])->first();
			if ($data) {
				$community = Communities::find($request->community_id);
				$id = $community->id;
				$result = $community->user()->attach($request->users);
				$result = Communities::where('id', $id)->with('user')->get();

				$res = User::whereIn('id', $request->users)->pluck('device_token')->toArray();

				$msg = 'Congrats!! You are added to a new ('.$community->name.') community.';

				foreach ($push_data as $key => $value) {
					Pushcreate($value,$msg);
				}

				sendPushnotification($res,'Geeniuz',$msg);

				return response()->json(['success' => true, 'community' => $result, 'message' => 'users has been added in community!.'], 201);
			} else {
				return response()->json(['success' => false, 'message' => 'community does not exist.'], 409);
			}
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to add users in community.'], 409);
		}
	}

	public function addincommunitybyhimself(Request $request) {
		$uid = $request->user()->id;

		try {
			/*$data = Communities::where(['id' => $request->community_id , 'creator_id' => $uid])->first();
            if($data){*/
			$community = Communities::find($request->community_id);
			$id = $community->id;
			$result = $community->user()->attach($request->user_id);
			$result = Communities::where('id', $id)->with('user')->get();

			return response()->json(['success' => true, 'community' => $result, 'message' => 'users has been added in community!.'], 201);
			/*}
				            else{
				                return response()->json(['success' => false, 'message' => 'community does not exist.'], 409);
			*/
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to add users in community.'], 409);
		}
	}

	public function deleteUsertocommunity(Request $request) {
		$uid = $request->user()->id;
		try {
			$data = Communities::where(['id' => $request->community_id, 'creator_id' => $uid])->first();
			if ($data) {
				$community = Communities::find($request->community_id);
				$id = $community->id;
				$result = $community->user()->detach($request->users);
				$result = Communities::where('id', $id)->with('user')->get();

				return response()->json(['success' => true, 'community' => $result, 'message' => 'users has been delete from community!.'], 201);
			} else {
				return response()->json(['success' => false, 'message' => 'community does not exist.'], 409);
			}
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to delete users from community.'], 409);
		}
	}

	public function leftCommunity(Request $request) {
		$uid = $request->user()->id;
		$users[] = $uid;
		try {
			$community = Communities::find($request->community_id);
			$id = $community->id;
			$result = $community->user()->detach($users);

			$user = User::where('id',$uid)->first(); 

			$communityCreator = Communities::where('id', $request->community_id)->with('creator')->first();

			$msg = $user->first_name.' has left the community.';

			Pushcreate($communityCreator->creator->id,$msg);
			
			sendPushnotification($communityCreator->creator->device_token, 'Geeniuz' ,$msg);

			return response()->json(['success' => true, 'message' => 'you left the community successfully!.'], 201);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to left from community.'], 409);
		}
	}

	public function createFeed(Request $request) {
		$data = $request->all();
		$request->validate([
			'message' => 'required|string',
		]);

		try {
			$dataExist = Feeds::where(['businesses_id' => $data['businesses_id'], 'user_id' => $data['user_id'], 'type_of_feed' => $data['type_of_feed']])->first();

			if (!empty($dataExist)) {
				return response()->json(['success' => true, 'message' => 'already feeds exist!.'], 200);
			}

			$feed = Feeds::create($data);
			$insertData = array('business_id' => $feed->businesses_id, 'awards' => 1);

			//Business awared = if recommend a business by user---------------------
			if (isset($feed->businesses_id) && $feed->type_of_feed == 2) {
				$Business_awards_data = Business_awards::where('business_id', $feed->businesses_id)->first();

				if ($Business_awards_data) {
					Business_awards::where('business_id', $feed->businesses_id)->update(['awards' => $Business_awards_data->awards + 1]);
				} else {
					Business_awards::create($insertData);
				}
			}

			$businessData = Business::with('user')->where('id',$feed->businesses_id)->first();

			$msg = 'Someone Checked In/Reccomended to our Restaurant.';

			Pushcreate($businessData->user->id,$msg);

			sendPushnotification($businessData->user->device_token,'Geeniuz',$msg);
			//----------------------------------------------------------------------
			return response()->json(['success' => true, 'feed' => $feed, 'message' => 'Feed has been created!.'], 200);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to create feed.'], 409);
		}
	}

	/*Get all feeds with likebyme*/
	public function getallFeed(Request $request) {
		try {
			$uid = $request->user()->id;
			$data_array = array();
			$feeds = Feeds::with('user')->get();
			foreach ($feeds as $key => $value) {
				$images = Business::with('images')->where('id', $value->businesses_id)->get();
				$var = checkLikedByMe($value['id'], $uid); //Checking likes on feeds from the function
				$value['liked_by_me'] = $var ? true : false;
				$value['businesses'] = $images;
				$data_array[] = $value;
			}
			return response()->json(['success' => true, 'feed' => $data_array, 'message' => 'Fetched all feeds!.'], 200);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to fetched feeds!.'], 409);
		}
	}

	public function getLikescount(Request $request) {
		// groupby feeds_IDs
		$count = Feeds_likes::select('feeds_likes.likes')
			->groupBy('feeds_likes.feeds_id')
			->count();
		print_r($count);die;

	}

	public function feedComments(Request $request) {
		$data = $request->all();
		$request->validate([
			'feeds_id' => 'required ',
			'user_id' => 'required',
			'comment' => 'required|string',
		]);
		try {
			$feeds = Feed_comment::create($request->all());
			$commenter = User::where('id',$request['user_id'])->first();

			$feedOwner = Feeds::with('user')->where('id',$request['feeds_id'])->first();

			$msg = $commenter->first_name.' commented on your post.';

			Pushcreate($feedOwner->user->id,$msg);

			sendPushnotification($feedOwner->user->device_token,'Geeniuz', $msg);

			return response()->json(['success' => true, 'message' => 'Comment posted!.'], 200);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to post feed comment.'], 409);
		}
	}

	public function getfeedComments(Request $request) {
		$data = $request->all();
		$request->validate([
			'feeds_id' => 'required ',
		]);
		try {
			$feeds = Feed_comment::where('feeds_id', $request->feeds_id)->with('user')->get();

			if ($feeds) {
				$count = $feeds->count();
			}
			return response()->json(['success' => true, 'message' => 'get feed comments!.', 'comments' => $feeds, 'count' => $count], 200);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to get feed comments.'], 409);
		}
	}

	public function likeDislike(Request $request) {
		$data = $request->all();
		$request->validate([
			'feeds_id' => 'required ',
		]);

		try {
			$feeds = Feeds_likes::updateOrCreate(
				['feeds_id' => $data['feeds_id'], 'user_id' => $data['user_id']],
				['likes' => $data['likes']]
			);

			$feedLiker = User::where('id',$data['user_id'])->first();

			$feedOwner = Feeds::with('user')->where('id',$request['feeds_id'])->first();

			$msg = $feedLiker->first_name.' Liked your post.';

			Pushcreate($businessData->user->id,$msg);

			sendPushnotification($businessData->user->device_token,'Geeniuz', $msg);

			/*die$feeds  = Feeds_likes::create($request->all());*/
			return response()->json(['success' => true, 'message' => 'Feed liked by user!.'], 200);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to liked feeds!.'], 409);
		}
	}
}
