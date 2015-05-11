@extends('admin.main')

@section('content')
	<div class="windowBlocker">
		<div class="content row panel panel-default">
			<div class="panel-heading">Вход</div>
			<div class="panel-body">
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Ошибка!</strong><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-4 control-label">E-Mail адрес</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Пароль</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember">Запомнить меня
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">Войти</button>

						<!--	<a class="btn btn-link" href="{{ url('/password/email') }}">Забыли пароль?</a>-->
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection