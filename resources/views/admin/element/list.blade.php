@extends('admin.element.section')

@section('sectionContent')

	@if (count($errors) > 0)
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{{$error}}</div>
		@endforeach
	@endif
	
	@if (isset($messages))
		@foreach ($messages as $message)
			<div class="alert alert-success" role="alert">{{$message}}</div>
		@endforeach
	@endif

	@if (isset($list))
		<table class="table table-striped">
			@if (isset($list['header']))
				<thead>
					<tr>
						<td></td>
						@foreach ($list['header'] as $field) 
							<td>{{$field['title']}}</td>
						@endforeach
						<td></td>
					</tr>
				</thead>
			@endif
			@if (isset($list['data']))	
				<tbody>
					@foreach ($list['data'] as $elem)
						<tr>
							<td><a href="{{ route($page_data['base_route'] . '.show', $elem['id'])}}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open single"></i></a></td>
							@foreach ($elem['values'] as $value)
								<td>{{$value}}</td>
							@endforeach
							<td>
								<form action="{{ route($page_data['base_route']. '.destroy', $elem['id'])}}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash single"></i></button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			@endif
		</table>
	@endif
	
	<a href="{{route($page_data['base_route'] . '.create')}}" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus"></i>Добавить элемент</a>


@endsection