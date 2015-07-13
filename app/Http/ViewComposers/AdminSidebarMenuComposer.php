<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminSidebarMenuComposer
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
	 * compose Sidebar Menu
	 * @param  View   $view [description]
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->withSidebarMenu($this->generateMenu());
	}

 	/**
 	 * Generate sidebarMenu
 	 * @return [type] [description]
 	 */
 	private function generateMenu()
 	{
 		$currentUrl = $this->request->url();

 		return array(
 			array(
 				'href'   => route('admin.region.index'),
 				'link'   => 'Cистемы организма',
 				'active' => strrpos($this->request->route()->getName(), 'admin.region') !== false,
 			),
 		);
 	}
}