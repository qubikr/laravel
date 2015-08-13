<?php namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * The user model instance
	 * @var User
	 */
	protected $users;

	/**
	 * [__constract description]
	 * @param  User   $userModel 
	 */
	public function __construct(User $userModel)
	{
		$this->users = $userModel;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		// 
		$data = $this->users->all();

		return view('admin.user.list')->withData($data)
									  ->withMessages($request->session()->get('messages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('admin.user.form');
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
			[
				'email' => 'required|email|unique:users',
				'password' => 'required|min:6',
				'password_confirm' => 'required|same:password',
			], 
			[
				'email.required' => 'Поле email не заполнено',
				'email.email' => 'Введите верный email',
				'email.unique' => 'Такой email уже существует!',
				'password.required' => 'Задайте пароль',
				'password.min' => 'Пароль должен быть длиной не менее 6 символов',
				'password_confirm.required' => 'Введите подтверждение пароля',
				'password_confirm.same' => 'Подтверждение пароля введено не верно',
			]
		);

		$input = $request->all();
		
		$user = $this->users->create($input);
		$user->password = bcrypt($input['password']);
		$user->save();

		return redirect()->route('admin.user.index')
					     ->with('messages', array('Пользователь успешно создан'));
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
		$data = $this->users->find($id);

		return view('admin.user.form')->withUser($data);
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
		$data = $this->users->find($id);

		return view('admin.user.form')->withUser($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//
		
		$this->validate(
			$request,
			[
				'email' => 'required|email|unique:users,email,' . $id,
				'password' => 'min:6',
				'password_confirm' => 'same:password',
			], 
			[
				'email.required' => 'Поле email не может быть пустым',
				'email.email' => 'Введите верный email',
				'email.unique' => 'Такой email уже существует!',
				'password.min' => 'Пароль должен быть длиной не менее 6 символов',
				'password_confirm.same' => 'Подтверждение пароля введено не верно',
			]
		);

		$input = $request->all();
		unset($input['_method'], $input['_token'], $input['password_confirm']);

		$user = $this->users->find($id);

		foreach ($input as $key=>$value) {
			if ($key == 'password') {
				if ($value !== '') {
					$user['password'] = bcrypt($value);
				}
			} else {
				$user[$key] = $value;	
			}				
		}

		$user->save();
		
		return redirect()->route('admin.user.index')
						 ->with('messages', array('Данные пользователя успешно обновлены'));
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
		if ($id == 1) {
			return redirect()->route('admin.user.index')
							 ->withErrors(array('Ошибка! Администратора системы удалить нельзя!'));
		}
		$user = $this->users->find($id);

		$this->users->destroy($id);
		return redirect()->route('admin.user.index')
						 ->with('messages', array('Пользователь "<strong>' . (isset($user['name']) ? $user['name'] : 'USERNAME') . '</strong>" (id='.$id.') успешно удален'));
	}
}
