<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trip;
use Carbon\Carbon;
use DB;
use App\AppLogin;

class SaveTripController extends Controller {

	public function saveTrip(Request $request) {

		if($request->has('hotel') and $request->has('route')
				and $request->has('times_to_stay') and $request->has('waypoints')
				and $request->has('transport_method') and $request->has('creator')
				and $request->has('start_date_time') and $request->has('app_id')
				and $request->has('key') and $request->has('trip_id')) {

			$login = DB::table('app_logins')->where('key', $request->key)
					->where('app_id', $request->app_id)->first();
			if($login != null and $login->valid_until < time()) {

				//TODO: Start time is not being saved

				$trip = new Trip;
				$trip->start_date_time = $request->start_date_time;
				$trip->hotel = $request->hotel;
				$trip->waypoints = $request->waypoints;
				$trip->times_to_stay = $request->times_to_stay;
				$trip->route = $request->route;
				$trip->transport_method = $request->transport_method;
				$trip->creator = $login->user_id;
				$trip->app_trip_id = $request->trip_id;
				$trip->app_id = $request->app_id;
				$trip->save();
				return "OK";
			}
			else {
				return "Invalid Login";
			}

		}
		else {
			return "Bad Request";

		}

	}


}

?>
