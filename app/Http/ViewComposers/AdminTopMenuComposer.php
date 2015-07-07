<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminTopMenuComposer
{
	/**
	 * Request injection
	 * @var Request
	 */
	protected $request;

	/**
	 * Constructor
	 * @param Request $request 
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * [compose description]
	 * @param  View   $view [description]
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->withTopMenu($this->generateMenu());
	}

	/**
	 * return current logged user name
	 * @return string
	 */
	private function getUserName()
	{

		$user = $this->request->user();

		$name = trim($user->first_name . ' ' . $user->second_name);

		if ($name === "") {
			$name = 'USERNAME';
		};

		return $name == "" ? 'USERNAME' : $name;
 	}

 	private function generateMenu()
 	{
 		$currentUrl = $this->request->url();
 		$user = $this->request->user();

 		if (empty($user)) {
 			return array();
 		}

 		return array(
 			array(
 				'prefix' => 'Добрый день,',
 				'href'   => route('admin.user.show', $this->request->user()->id),
 				'link'   => $this->getUserName(),
 				'active' => $currentUrl == route('admin.user.show', $user->id) || $currentUrl == route('admin.user.edit', $user->id),
 			),

 			array(
 				'prefix' => '',
 				'href'   => route('admin.user.index'),
 				'link'	 => 'Управление пользователями',
 				'active' => $currentUrl == route('admin.user.index'),
			),	

 			array(
 				'prefix' => '',
 				'href' => route('admin.index'),
 				'link' => 'Рабочий стол',
 				'active' => $currentUrl == route('admin.index'),
 			),

 			array(
 				'prefix' => '',
 				'href' => route('admin.logout'),
 				'link' => 'Выход',
 			)
 		);
 	}
}