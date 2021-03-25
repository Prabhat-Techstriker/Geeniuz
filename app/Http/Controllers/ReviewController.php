<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Review_images;

class ReviewController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'business_id' => 'required|integer|unique:reviews,business_id,NULL,id,user_id,'.$request->input('user_id'),
            'rating' => 'required|numeric|between:0,5',
            'review' => 'required|string|between:5,300',
        ]);
        
        try {
            $review = Review::create($request->all());
            $last_id = $review->id;
            if(!empty($request->image)){
                
            $path  = array();
            if ($image = $request->file('image')) {
                foreach ($image as $files) { 
                    $filenameWithExt = $files->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $files->getClientOriginalExtension();
                    $mimeType = $files->getClientMimeType();
                    $fileNameToStore = str_replace(" ", "-", $filename) . '_' . time() . '.' . $extension;
                    $path = $files->storeAs('images', $fileNameToStore);

                    $img_upload = Review_images::create([
                            'review_id' => $last_id,
                            'user_id' => $request->user_id,
                            'image' => $path,
                        ]);
                }
            }
        }
            return response()->json(['status' => 'success', 'review' => $review, 'message' => 'Review has been listed.'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add your review.'], 409);
        }
    }

    public function reviewsList(Request $request){
        $data = Review::with('review_images')->get();
        return response()->json(['status' => 'success', 'review' => $data, 'message' => 'Review has been listed.'], 201);
    }
}
