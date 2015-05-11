<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller {

	/**
	 *  Admin desctop controller
	 */
	

	public function index()
	{
		return view('admin.main');
	}
}