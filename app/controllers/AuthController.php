<?php

class AuthController extends BaseController {

	public function showLogin(){ return View::make('auth.login'); }

	public function doLogin()
	{
		$rules = array(
			'email' => 'required|email',
			'password' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
		{
			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
		}else
		{
			$logindata = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			);

			if(Auth::attempt($logindata))
			{
				$user = User::find(Auth::user()->id);
				$user->online = 1;
				$user->save();
				return Redirect::to('/');
			}else
			{
				return Redirect::to('login');
			}
		}
	}

	public function doLogout()
	{
		$user = User::find(Auth::user()->id);
		$user->online = 0;
		$user->save();
		Auth::logout();
		return Redirect::to('/');
	}

	public function registerAccount()
	{
		$user = new User;
		
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->firstname = Input::get('firstname');
		$user->lastname = Input::get('lastname');
		$user->accessid = "1";

		$user->save();

		Mail::send('emails.welcome', array(), function($message)
		{
		  $message->from('no-reply@kurone.me', Config::get('app.projectname') . ' Team');
		  $message->to(Input::get('email'))->subject('Welcome to ' . Config::get('app.projectname') . '!');
		});

		return View::make('auth.confirmation', array('email' => Input::get('email'), 'firstname' => Input::get('firstname')));
	}

}
