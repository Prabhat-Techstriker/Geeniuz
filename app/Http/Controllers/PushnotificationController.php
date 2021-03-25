<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pushnotification;

class PushnotificationController extends Controller
{
	public function create(Request $request){
		/*$data = $request->all();
		$userId = $request->user()->id;*/
		$request->validate([
			'message' => 'required|string',
		]);

		Pushnotification::create($request->all());
	}

	public function show(){
		try {
			$data = Pushnotification::get();
			return response()->json(['status' => 'success', 'message' => 'profile fetched successfully!.', 'pushnotification' => $data], 200);
		} catch (Exception $e) {
			return response()->json(['status' => 'error' , 'message' => 'failed to get profile!.'], 400);
		}
	}
}
