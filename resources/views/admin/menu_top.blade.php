<ul class="nav navbar-nav navbar-right">
	@foreach ($top_menu as $item)
		<li{!! isset($item['active']) && $item['active'] ? ' class="active"' : '' !!}>
			<a href="{{ $item['href']}}">{{ $item['prefix'] }} {{ $item['link']}}</a>
		</li>
	@endforeach
</ul>