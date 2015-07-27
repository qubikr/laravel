@extends('admin.user.section')

@section('sectionContent')

<a href="{{route('admin.user.index')}}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Назад к списку пользователей</a>
<hr>
<form action="{{(isset($user) ? route('admin.user.update', $user->id) : route('admin.user.store'))}}" 
	  method="POST" class="form-horizontal" role="form">

		@if (isset($user))
			c
		@endif
		
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
		
		<div class="form-group">

			<label class="col-md-3 control-label" for="email">Email:</label>
			<div class="col-md-3">
				<input type="email" class="form-control" name="email" 
					value="{{(old('email') ? old('email') : (isset($user) ? $user->email : ''))}}">					
			</div>
				{!!$errors->first('email', '<div class="alert alert-danger col-md-5" role="alert">:message</div>')!!}
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label" for="first_name">Имя:</label>
			<div class="col-md-3">
				<input type="text" class="form-control" name="first_name" 
					value="{{(old('first_name') ? old('first_name') : (isset($user) ? $user->first_name : ''))}}">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label" for="last_name">Фамилия:</label>
			<div class="col-md-3">
				<input type="text" class="form-control" name="last_name" 
					value="{{(old('last_name') ? old('last_name') : (isset($user) ? $user->last_name : ''))}}">
			</div>
		</div>
		<div class="form-group">
			<hr class="col-md-6">
		</div>
		@if (Route::currentRouteName() != 'admin.user.show')
			@if (Route::currentRouteName() == 'admin.user.edit')
				<h4>Смена пароля</h4>
			@endif
			<div class="form-group">
				<label class="col-md-3 control-label" for="password">{{Route::currentRouteName() == 'admin.user.edit' ? 'Новый пароль:' : 'Пароль:'}}</label>
				<div class="col-md-3">
					<input type="password" class="form-control" name="password">
				</div>
				{!!$errors->first('password', '<div class="alert alert-danger col-md-5" role="alert">:message</div>')!!}
			</div>
			<div class="form-group">		
				<label class="col-md-3 control-label" for"password_confirm">Подверждение пароля:</label>
				<div class="col-md-3">
					<input type="password" class="form-control" name="password_confirm">
				</div>
				{!!$errors->first('password_confirm', '<div class="alert alert-danger col-md-5" role="alert">:message</div>')!!}
			</div>
			<div class="form-group">
				<div class="col-md-3 col-md-offset-3">
					<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-save"></i> Сохранить</button>
				</div>
			</div>

		@else
			<div class="form-group">
				<div class="col-md-3 col-md-offset-3">
					<a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Редактировать</a>
				</div>
			</div>

		@endif


</form>
@endsection