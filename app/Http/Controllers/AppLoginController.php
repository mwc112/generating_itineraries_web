<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\AppLogin;
use DB;

class AppLoginController extends Controller {

	public function getToken(Request $request) {

		if($request->has('email') and $request->has('password') and
				$request->has('app_id')) {
			$user = DB::table('users')->where('email', $request->email)->first();
			if($user != null and password_verify($request->password, $user->password)) {
				$login = DB::table('app_logins')->where('user_id', $user->id)
						->where('app_id', $request->app_id)->first();
			
				if($login != null) {
					DB::table('app_logins')->where('id', $login->id)
							->update(['valid_until'=> time() + 60 * 60 * 24 * 7]);

					return $login->key;
				}
				else {
					$new_login = new AppLogin;
					$new_login->user_id = $user->id;
					$new_login->app_id = $request->app_id;
					$new_login->key = md5($user->id . $user->email . date('mY'));
					$new_login->valid_until = time() + 60 * 60 * 24 * 7;
					$new_login->save();
					return $new_login->key;

				}
			}
		}

		return "Bad Request";

	}

}

?>