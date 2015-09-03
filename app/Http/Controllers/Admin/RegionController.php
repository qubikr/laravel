<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Region;

class RegionController extends Controller {


	/**
	 * Region model instance
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
	public function index(Request $request, $page = 1)
	{
		//		

		$baseRoute = $request->route()->getName();
		$baseRoute = substr($baseRoute, 0, strripos($baseRoute, '.'));

		$list = $this->region->getList($page);

		if ($list['pagination']['currentPage'] > $list['pagination']['count']) {
			return redirect(route('admin.region.index') . '/page/' . $list['pagination']['count']);
		}

		return view('admin.element.list')->withList($list)
										 ->withMessages($request->session()->get('messages'));
	}

	/**
	 * Show the form for creating a new resource.
	 */

	public function create()
	{
		//
		
		return view('admin.element.form')->withElement($this->region->getTemplate());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		$request = $this->updateRequest($request);

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

		return view('admin.element.form')->withElement($region)
										 ->withElementId($id);
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

        $region = $this->region->getElement($id);
        return view('admin.element.form')->withElement($region)
        								 ->withElementId($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//

		$request = $this->updateRequest($request);

		$this->validate($request, $this->region->getValidationRules());

		$input = $request->all();
		unset($input['_method'], $input['_token']);

		$region = $this->region->find($id);

		foreach ($input as $key => $value) {
			$region[$key] = $value;
		}

		$region->save();

		return redirect()->route('admin.region.index')
						->with('messages', array('Раздел успешно обновлен'));
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
		
		$name = $this->region->find($id)->name;
		$this->region->destroy($id);

		return redirect()->route('admin.region.index')
						 ->with('messages', array("Раздел <strong>\"$name\"</strong> (id:$id) успешно удален"));
	}
	
	/**
	 * Proccess the request variables of multyply type
	 * @param  Request $request - initial request
	 * @return Request - updated request
	 */
	private function updateRequest($request)
	{
		$vars = $request->all();

		if (isset($vars['form_multiply_type'])) {
			foreach ($vars['form_multiply_type'] as $type) {
				if (isset($vars[$type])) {
					$field_value = 0;
					foreach ($vars[$type] as $value) {
						$field_value += $value;
					}
					$vars[$type] = $field_value;
				}
			}
			unset($vars['form_multiply_type']);
		}

		$request->replace($vars);

		return $request;
	}

}
		