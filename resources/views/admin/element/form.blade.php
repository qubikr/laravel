@extends('admin.element.section')

@section('sectionContent')

	<a href="{{route($page_data['base_route'] . '.index')}}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> назад</a>
	<hr>

	@if(isset($element))
		<pre>
			{{print_r($element)}}
		</pre>
	@endif

	<form action="{{route('admin.region.store')}}" method="POST" class="form-horizontal" role="form">
		
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		@if(isset($template))
			@foreach ($template as $key=>$value)

				<div class="form-group">
					<label class="col-md-3 control-label" for="$key">{{$value['title']}}</label>

						@if($value['type'] == 'text')
							<div class="col-md-3">
								<input type="text" class="form-control" name="{{$key}}" value="{{old($value['type'])}}">	
							</div>
						@elseif($value['type'] == 'textarea')
							<div class="col-md-6">
								<textarea class="form-control" name="{{$key}}">{{old($value['type'])}}</textarea>
							</div>
						@elseif($value['type'] == 'textarea-big')
							<div class="col-md-8">
								<textarea  rows="10" class="form-control" name="{{$key}}">{{old($value['type'])}}</textarea>
							</div>
						@endif
				</div>

			@endforeach
		@endif
	
		<div class="form-group">
			<div class="col-md-3 col-md-offset-3">
				<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-save"></i> Сохранить</button>
			</div>
		</div>

	</form>
	
@endsection;