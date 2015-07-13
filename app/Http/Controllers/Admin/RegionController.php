<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Region;

class RegionController extends Controller {


	/**
	 * Region model intance
	 * @var [type]
	 */
	protected $region;

	/**
	 * constroller constructor
	 * @param Region $regionModel [description]
	 */
	public function __construct(Region $regionModel)
	{
		$this->region = $regionModel;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//		
				
		$baseRoute = $request->route()->getName();
		$baseRoute = substr($baseRoute, 0, strripos($baseRoute, '.'));

		return view('admin.element.list')->withList($this->region->getList())
										 ->withMessages($request->session()->get('messages'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request)
	{
		//
		
		return view('admin.element.form')->withTemplate($this->region->getTemplate());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//

		$this->validate(
			$request, 
			$this->region->getValidationRules()
		);

		$this->region->create($request->all())->save();

		return redirect()->route('admin.region.index')
						 ->with('messages', array('Рездел успешно добавлен'));
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		
		$region = $this->region->getElement($id);

		return view('admin.element.form')->withElement($region);


	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
