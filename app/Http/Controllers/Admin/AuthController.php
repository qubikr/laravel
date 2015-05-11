<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Classes\Auth\AuthenticatesUser;

use Illuminate\Contracts\Auth\Guard;

class AuthController extends Controller {

	/**
	 *  Authentication controller
	 */

	use AuthenticatesUser;	

	/**
	 * Create new authentication controller instance
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
}