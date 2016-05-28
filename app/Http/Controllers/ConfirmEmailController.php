<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Confirm;
use App\User;
use DB;

class ConfirmEmailController extends Controller {

	public function confirmEmail(Request $request) {
		if($request->has('key') and $request->has('email')) {
			$confirm = DB::table('confirms')->where('email', $request->email)->first();
			if($confirm != null and $request->key == $confirm->key) {
				DB::table('users')->where('email', $confirm->email)
													->update(['confirmed' => 1]);

					return view('confirmed_email');
				
			}
		}
		else {
			return view('confirm_email');
		}

		return view('not_confirmed_email');
	}

}

?>
