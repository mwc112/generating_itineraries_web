<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;

class ShowUserController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function showUser(Request $request) {
		$user = Auth::user();
		return view('showUser', ['user' => $user]);
	}

	public function updateUser(Request $request) {
		$user = Auth::user();
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->age = $request->age;
		$user->email = $request->email;
		$user->save();
	}

}

?>
