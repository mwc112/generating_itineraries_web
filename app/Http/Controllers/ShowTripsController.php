<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Upload;
use DB;
use Auth;

class ShowTripsController extends Controller {

	public function showTrips(Request $request) {

		$trips = DB::table('trips')->get();
		if(Auth::check()) {
			$uploaded = DB::table('uploads')->where('user_id', Auth::id())->get();
		}

		return view('show_trips', ['trips' => $trips, 'uploaded' => $uploaded]);

	}


	public function markTrips(Request $request) {

		$marked = DB::table('uploads')->where('trip_id', $request->id)
				->where('user_id', Auth::id())->get();
		if(count($marked) == 0) {
		
			$upload = new Upload;
			$upload->user_id = Auth::id();
			$upload->uploaded = false;
			$upload->trip_id = $request->id;
			$upload->save();
			

		}

	}

}

?>
