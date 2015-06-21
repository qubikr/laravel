@extends('admin.main')

@section('content')

	<h1 class="page-header">Пользователи</h1>

	<table class="table table-striped">
		<thead>
			<tr>
				<td></td>
				<td>#</td>
				<td>Email</td>
				<td>Имя</td>
				<td>Фамилия</td>
				<td></td>

			</tr>
		</thead>
		<tbody>
			@foreach ($data as $user)
				<td><a href="{{ action('Admin\User\UserController@show', $user->id)}}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i></a></td>
				<td>{{$user->id}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->first_name}}</td>
				<td>{{$user->last_name}}</td>
				<td><a href="{{ action('Admin\User\UserController@destroy', $user->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
			@endforeach
		</tbody>
	</table>

@endsection