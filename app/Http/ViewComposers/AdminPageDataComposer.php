<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


Class AdminPageDataComposer
{


	/**
	 * Request injection
	 * @var Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * Constructor, Request class injection
	 * @param Request $request [description]
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Pass data to view;
	 * @param  View   $view [description]
	 * @return [type]       [description]
	 */
	public function compose(View $view)
	{
		$view->withPageData($this->getBaseRoute());
	}


	/**
	 * get Route name
	 * @return string
	 */
	protected function getBaseRoute()
	{
		$routeName = $this->request->route()->getName();
		$delimeterPositon = strripos($routeName, '.');

		return [
			'base_route' => substr($routeName, 0, $delimeterPositon), 
			'action' 	 => substr($routeName, $delimeterPositon + 1),
		];
	}
}