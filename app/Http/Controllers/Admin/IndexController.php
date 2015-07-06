<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller {

	/**
	 *  Admin desctop controller
	 */

	public function index(Request $request)
	{
		echo '<pre>';
		print_r($request->user());
		echo '</pre>';
		return;
		return view('admin.main');
	}
}