<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trip;
use Carbon\Carbon;

class SaveTripController extends Controller {

	public function saveTrip(Request $request) {

		if($request->has('hotel') and $request->has('route')
				and $request->has('times_to_stay') and $request->has('waypoints')
				and $request->has('transport_method') and $request->has('creator')
				and $request->has('start_date_time')) {

			$trip = new Trip;
			$trip->start_date_time = $request->start_date_time;
			$trip->hotel = $request->hotel;
			$trip->waypoints = $request->waypoints;
			$trip->times_to_stay = $request->times_to_stay;
			$trip->route = $request->route;
			$trip->transport_method = $request->transport_method;
			$trip->creator = $request->creator;
			$trip->save();
			return "OK";


		}
		else {
			return "Bad Request";

		}

	}


}

?>
