<?php namespace App\Classes\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

trait AuthenticatesUser {

	/**
	 * The Guard implementation
	 *
	 * @var \Illuminate\Contracts\Auth\Guard
	 */
	protected $auth;


	/**
	 * The Registrar implementation
	 * @var \Illuminate\Contracts\Auth\Registrar
	 */
//	protected $registrar;

	/**
	 * Show the authentication form
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('admin.login');
	}

	public function postLogin(Request $request)
	{
		
		$this->validate(
			$request, 
			[
				'email' => 'required|email', 
				'password' => 'required',
			],
			[
				'email.required' => 'Поле email не заполнено',
				'email.email'    => 'Введен не верный email',
				'password.required' => 'Пароль не введен',
			]
		);

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember'))) {
			return redirect()->route('admin.index');
		}

		return redirect()->route('admin.login')
						 ->withInput($credentials)
						 ->withErrors( ['email' => 'Неверный email или пароль']);
	}

	public function anyLogout()
	{
		$this->auth->logout();

		return redirect()->route('admin.index');
	}
}

