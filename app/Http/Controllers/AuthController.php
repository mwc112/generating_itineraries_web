<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Confirm;
use Validator;
use Auth;
use Session;
use Mail;

class AuthController extends Controller {

	//public function __construct() {
	//	$this->middleware('auth');
	//}
	
	public function showRegistrationForm() {
		return view('register');
	}

	public function register(Request $request) {
		/* TODO: Make validation work */
		//validate_user($request);

		$user = new User;
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->age = $request->age;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		//TODO: Modify so that can't login without confirmation
		$user->confirmed = 0;
		$user->save();

		$confirm = new Confirm;
		$confirm->email = $user->email;
		$confirm->user_id = $user->id;
		$confirm->key = md5($user->id . $user->email . date('mY'));
		$confirm->save();

		Mail::send('email.confirm', ['first_name' => $user->first_name,
																	'key' => $confirm->key],
										function($message) use ($user){
											$message->to($user->email, $user->first_name . 
																										' ' .
																										$user->last_name)
															->subject('Confirm your account');
											$message->from('somewhere@somewhere.com', 'app');
										});
		
		return redirect('/confirm_email');
	}


	protected function validate_user(Request $request) {
		$validator = Validator::make($request->all(), [
						'first_name' => 'required|max:255|string',
						'last_name' => 'required|max:255|string',
						'age' => 'required|integer',
						'email' => 'required|max:255|string|unique:users',
						'password' => 'confirmed|max:255|string'
        ]);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }


		/*$this->validate($request, [
			'first_name' => 'required|max:255|string',
			'last_name' => 'required|max:255|string',
			'age' => 'required|integer',
			'email' => 'required|max:255|string|unique:users',
			'password' => 'confirmed|max:255|string'
		]);*/
	}


	public function authenticateUser(Request $request) {
		if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password,
												'confirmed'=>1]))
		{
			return redirect()->intended('');
		}
		else {
			Session::flash('bad_login', 'Sorry, your username or password was not
																			recognised.  Have you confirmed
																			your email address?');
			return redirect('login');
		}

	}

	public function logout(Request $request) {
		Auth::logout();
		return view('home');
	}
}

?>
