<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class authAdmin {

	/**
	 * The guard implementation
	 *
	 * @var Guard
	 */
	
	protected $auth;

	/**
	 * Greate new filter instance
	 * 
	 * @param  Guard  $auth 
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle request
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized', 401);
			}
			else
			{
				$routeName = $request->route()->getName();
				if ($routeName != 'admin.loginForm' && $routeName != 'admin.login') {
					return redirect()->guest(route('admin.loginForm'));
				}
			}
		}

		return $next($request);
	}
}