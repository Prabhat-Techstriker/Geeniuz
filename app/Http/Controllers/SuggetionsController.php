<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suggetions;
use App\User;

class SuggetionsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'subject'       => 'required|string',
            'message'       => 'required|string',
            'business_id'   => 'required',
        ]);

        try {
            $suggestion = Suggetions::create($request->all());

            $userSuggetion = User::where('id',$request['user_id'])->first();

            $businessData = Business::with('user')->where('id',$request['businesses_id'])->first();

            $msg = $userSuggetion->first_name.' Suggested changes to our business.';

            Pushcreate($businessData->user->id,$msg);

            sendPushnotification($businessData->user->device_token,'Geeniuz', $msg);

            return response()->json(['success' => true, 'suggestion' => $suggestion, 'message' => 'Suggestion has been created.'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create suggestion.'], 409);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $suggetions = Suggetions::with('user','businesses')->get();
        return response()->json(['success' => true, 'suggetions' =>  $suggetions, 'message' => 'Fetched all suggetions.'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Suggetions::where(['id' => $id])->delete();
           
            return response()->json(['success' => true, 'message' => 'suggetion has been deleted successfully!.'], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete suggetion.'], 409);
        }
    }
}
