<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller {

	/**
	 *  Admin desctop controller
	 */

	public function index(Request $request)
	{
		return view('admin.main');
	}
}