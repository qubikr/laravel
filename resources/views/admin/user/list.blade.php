@extends('admin.user.section')

@section('sectionContent')

	@if (count($errors) > 0)
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{!!$error!!}</div>
		@endforeach
	@endif
	
	
	@if (isset($messages))
		@foreach ($messages as $message)
			<div class="alert alert-success" role"alert">{!!$message!!}</div>
		@endforeach
	@endif
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
				<tr>
					<td><a href="{{ route('admin.user.show', $user->id)}}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open single"></i></a></td>
					<td>{{$user->id}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->first_name}}</td>
					<td>{{$user->last_name}}</td>
					<td>
						@if ($user->id > 1)
						<form action="{{ route('admin.user.destroy', $user->id)}}" method="POST">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash single"></i></button>
						</form>
						@endif
					</td>
				</tr>	
			@endforeach
		</tbody>
	</table>
	<a href="{{route('admin.user.create')}}" class="btn btn-success pull-right"><i class="glyphicon glyphicon-user"></i> Добавить пользователя</a>
@endsection