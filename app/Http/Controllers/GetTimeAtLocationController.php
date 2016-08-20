<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetTimeAtLocationController extends Controller {

	public function getTime(Request $request) {

		$types_time = [5 => 4];

		return $types_time[$request->place_type];

	}


}
