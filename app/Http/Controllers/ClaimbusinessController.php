<?php

namespace App\Http\Controllers;

use App\Business;
use App\Claim_business;
use App\User;
use Illuminate\Http\Request;

class ClaimbusinessController extends Controller {
	public function claimBusiness(Request $request) {
		$uid = $request->user()->id;

		$request->validate([
			'business_id' => 'required',
		]);

		try {
			$count = Claim_business::where(['business_id' => $request->business_id, 'claim_user_id' => $uid])->count();
			if ($count) {
				return response()->json(['success' => true, 'message' => 'Already requested to claim business!.'], 200);
			}

			$data = Business::where(['id' => $request->business_id])->first();
			$insert = array('claim_user_id' => $uid, 'business_id' => $data->id, 'business_creator_id' => $data->user_id);
			$result = Claim_business::create($insert);
			return response()->json(['success' => true, 'result' => $result, 'message' => 'your business claim request sent!.'], 201);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to claim business!.'], 409);
		}
	}

	public function listAllclaims(Request $request) {
		$uid = $request->user()->id;
		$data_array = array();
		try {
			$result = Claim_business::with('claimuser', 'creator')->get();
			foreach ($result as $key => $value) {
				$images = Business::with('images')->where('id', $value['business_id'])->get();
				$value['businesses'] = $images;
				$data_array[] = $value;
			}
			return response()->json(['success' => true, 'result' => $data_array, 'message' => 'list has been fetched!.'], 201);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to fetched claims.'], 409);
		}
	}

	public function claimApproval(Request $request) {
		$uid = $request->user()->id;

		try {
			$updateClaim = Claim_business::where(['id' => $request->id])->update(['approval_status' => 1]);
			$update_Claim = Claim_business::where(['id' => $request->id])->first();
			$updateBusiness = Business::where(['id' => $update_Claim->business_id])->update(['user_id' => $update_Claim->claim_user_id]);
			return response()->json(['success' => true, 'message' => 'business claim approved!.'], 201);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'Failed to approved claim.'], 409);
		}
	}

}
