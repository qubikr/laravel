<ul class="nav nav-sidebar">
	@foreach ($sidebar_menu as $item)
		<li{!! isset($item['active']) && $item['active'] ? ' class="active"' : '' !!}>
			<a href="{{ $item['href']}}">{{ $item['link']}}</a>
		</li>
	@endforeach
</ul>

