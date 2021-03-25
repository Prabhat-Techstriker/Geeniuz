<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category;
use App\Business;
use Carbon\Carbon;

class CategoryController extends Controller {

	public function __construct() {
        $this->middleware('auth:api');
    }

    public function show() {
        $parentCategories = Category::where('parent_id',0)->get();
        $categories = [];
        foreach ($parentCategories as $i => $category) {
            $categories[] = Category::with('subcategories')->where('id',$category->id)->first();
        }
        return response()->json(['success' => true, 'categories' =>  $categories, 'message' => 'Fetched all categories.'], 200);
    }

    public function showBusinessesByCat(Request $request, $id) {
        $request->validate([
            'home_delivery' => 'boolean',
            'subcat_id' => 'array',
            'open_now' => 'boolean',
        ]);

        try {
            //$businesses = Category::findOrFail($id)->businesses()->paginate(12); //find all business of the category by using relationship
            $conditions  = ['cat_id' => $id];
            if ($request->home_delivery) { // a search parameter
                $conditions += ['home_delivery' => $request->home_delivery];
            }

            //$businesses = Business::where($conditions)->paginate(12);
            $businesses = Business::with('images','businessTimings')->where($conditions)->get();
            if ($request->subcat_id) { // a search parameter
                //$businesses = Business::whereIn('subcat_id', $request->subcat_id)->where($conditions)->paginate(12);
                $businesses = Business::whereIn('subcat_id', $request->subcat_id)->where($conditions)->get();
            }

            if ($request->open_now) { // a search parameter
                $carbon  = Carbon::now();
                $timeNow = $carbon->toTimeString();
                $dayOfTheWeek = Carbon::now()->dayOfWeek;

                $businesses = Business::has('businessTimings')->with(["businessTimings" => function($q) use ($timeNow) {
                    $q->where('days', '=', Carbon::now()->dayOfWeek);
                    $q->where('opening_timing', '<=', $timeNow);
                    $q->where('closing_timing', '>=', $timeNow);
                }])->where('cat_id', $id)->get();

                if($request->subcat_id) { // if having Sub_cat Ids too
                    $businesses = Business::has('businessTimings')->with(["businessTimings" => function($q) use ($timeNow) {
                        $q->where('days', '=', Carbon::now()->dayOfWeek);
                        $q->where('opening_timing', '<=', $timeNow);
                        $q->where('closing_timing', '>=', $timeNow);
                    }])->whereIn('subcat_id', $request->subcat_id)->where('cat_id', $id)->get();
                }

                $openNow = [];
                $businesses = json_decode($businesses,true);
                foreach ($businesses as $business) {
                    if(!empty($business['business_timings'])) {
                        $openNow[] = $business;
                    }
                }
                $businesses = $openNow;
            }

            if(count($businesses) > 0 ) { //business found in DB
                return response()->json(['success' => true, 'businesses' =>  $businesses, 'message' => 'Fetched all businesses.'], 200);
            }
            return response()->json(['success' => true, 'message' => 'No business found.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => "category not found"], 404);
        }
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:categories',
            'description' => 'string',
            'parent_id' => 'required|integer',
        ]);

        try {
            $category = Category::create($request->all());
            return response()->json(['success' => true, 'category' => $category, 'message' => 'Category has been done created.'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create category.'], 409);
        }
    }

    public function update(Request $request, $id) {
        if (Category::where('id', $id)->exists()) {
            $category = Category::find($id);
            $category->name = is_null($request->name) ? $category->name : $request->name;
            $category->description = is_null($request->description) ? $category->description : $request->description;
            $category->parent_id = is_null($request->parent_id) ? $category->parent_id : $request->parent_id;
            $category->save();
            return response()->json(['success' => true, 'category' => $category, "message" => "Category updated successfully."], 201);
        } else {
            return response()->json(['success' => false, "message" => "Category not found"], 404);
      	}
    }

    public function delete($id) {
        if(Category::where('id', $id)->exists()) {
            $category = Category::find($id);
            $category->delete();
            return response()->json(['success' => true, "message" => "category deleted"], 202);
        } else {
            return response()->json(['success' => false, "message" => "category not found"], 404);
        }
    }

    public function getCat($id) { //Pass category ID.
        try {
            $category = Category::findOrFail($id);
            return response()->json(['success' => true, 'category' =>  $category, 'message' => 'Fetched all category.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => "category not found"], 404);
        }
    }

    public function getSubCat($id) { //Pass parent category ID.
        try {
            $category = Category::findOrFail($id);
            if(count($category->subcategories) > 0) {
                return response()->json(['success' => true, 'categories' =>  $category->subcategories, 'message' => 'Fetched all sub-categories.'], 200);
            }
            return response()->json(['success' => true, 'categories' =>  $category->subcategories, 'message' => 'No sub-categories found.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => "category not found"], 404);
        }
    }
}
