<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Feed_comment;
use App\Business;
use App\Save_user_businesses;
use App\Review;
use App\Feeds;
use App\Communities;
use App\Business_awards;
use App\Contact_list;
use App\Category;
use DB;

class SearchController extends Controller
{
	public function Search(Request $request)
	{
		try {
			$search = array();
			$users = User::where('first_name', 'LIKE', '%' . $request->search . '%')
					->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
					->orWhere('email', 'LIKE', '%' . $request->search . '%')
					->orWhere('phone', 'LIKE', '%' . $request->search . '%')
					->get();

			$businesses = Business::where('name', 'LIKE', '%' . $request->search . '%')
					->orWhere('phone', 'LIKE', '%' . $request->search . '%')
					->orWhere('email', 'LIKE', '%' . $request->search . '%')
					->get();

			$category = Category::where('name', 'LIKE', '%' . $request->search . '%')
					->get();

			$search['users'] 		= $users;
			$search['businesses'] 	= $businesses;
			$search['category'] 	= $category;

			return response()->json(['success' => true, 'search' =>  $search, 'message' => 'data fetched successfully.'], 200);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => 'data not found.'], 401);
		}
		
	}
}
