@extends('admin.element.section')

@section('sectionContent')

	<a href="{{route($page_data['base_route'] . '.index')}}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> назад</a>
	<hr>

	<form action="{{
		$page_data['action'] === 'create' ? route($page_data['base_route'].'.store') : route($page_data['base_route'].'.update', $element_id)

		}}" method="POST" class="form-horizontal" role="form">
		
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

        @if($page_data['action'] !== 'create')
            <input type="hidden" name="_method" value="PUT">
        @endif
			
		@if(isset($element))
			<ul class="nav nav-tabs" role="tablist">
			@foreach ($element as $code => $group)
				<li role="presentation" {!!($group['selected'] ? ' class="active"' : '')!!}><a href="#{{$code}}" role="tab" data-toggle="tab">{{$group['title']}}</a></li>
			@endforeach
			</ul>

			<div class="tab-content">
			@foreach ($element as $code => $group)
				<div role="tabpanel" class="tab-pane fade{{($group['selected'] ? ' active in' : '')}}" id="{{$code}}">
					@foreach ($group['fields'] as $key => $value)
						<br>
						<div class="form-group">
							<label class="col-md-3 control-label" for="{{$key}}">{{$value['title']}}</label>
							@if($value['type'] == 'text')
								<div class="col-md-3">
									<input type="text" class="form-control" name="{{$key}}" value="{{!is_null(old($key)) ? old($key) : (isset($value['value']) ? $value['value'] : '')}}">
								</div>
							@elseif($value['type'] == 'textarea')
								<div class="col-md-6">
									<textarea class="form-control" name="{{$key}}">{{!is_null(old($key)) ? old($key) : (isset($value['value']) ? $value['value'] : '')}}</textarea>
								</div>
							@elseif($value['type'] == 'textarea-big')
								<div class="col-md-8">
									<textarea rows="10" class="form-control" name="{{$key}}">{{!is_null(old($key)) ? old($key) : (isset($value['value']) ? $value['value'] : '')}}</textarea>
								</div>
							@elseif($value['type'] == 'gender')
								<div class="col-md-8">
									@include('admin.element.gender', ['value' => !is_null(old($key)) ? old($key) : (isset($value['value']) ? $value['value'] : 63)])
								</div>
							@endif
							{!!$errors->first($key, '<br><br><label class="col-md-8 col-md-offset-3" role="alert"><div class="alert alert-danger ">:message</div></label>')!!}
						</div>
					@endforeach
				</div>
			@endforeach
			</ul>
		@endif
		<hr>	
		<div class="form-group">
			<div class="col-md-3 col-md-offset-3">
				<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-save"></i> Сохранить</button>
			</div>
		</div>
	</form>
	
@endsection;