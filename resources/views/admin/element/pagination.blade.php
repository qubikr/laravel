@if ($data['count'] > 1)
<div class="row col-sm-12">
  <nav class="pull-right">
    <ul class="pagination">
      @if ($data['currentPage'] > 1)
        <li>
            <a href="{{route($page_data['base_route'] . '.index')}}/page/{{($data['currentPage'] - 1)}}" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
      @endif

      @if ($data['currentPage'] > 3)
        <li><a href="{{route($page_data['base_route'] . '.index')}}/page/1">1</a></li>
        
        @if ($data['currentPage'] > 4)
          <li><span>...</span></li>
        @endif
      @endif
      
      @for ($i=max(1, $data['currentPage'] - 2); $i < $data['currentPage']; $i++)    
        <li><a href="{{route($page_data['base_route'] . '.index')}}/page/{{$i}}">{{$i}}</a></li>
      @endfor
        
      <li class="active"><span>{{$data['currentPage']}}</span></li>

      @for ($i = $data['currentPage'] + 1; $i <= min($data['count'], $data['currentPage'] + 2); $i++)    
        <li><a href="{{route($page_data['base_route'] . '.index')}}/page/{{$i}}">{{$i}}</a></li>
      @endfor

      @if ($data['count'] - $data['currentPage'] > 2)
        @if ($data['count'] - $data['currentPage'] > 3)
          <li><span>...</span></li>
        @endif
        <li><a href="{{route($page_data['base_route'] . '.index')}}/page/{{$data['count']}}">{{$data['count']}}</a></li>
      @endif

      @if ($data['currentPage'] < $data['count'])
        <li>
          <a href="{{route($page_data['base_route'] . '.index')}}/page/{{($data['currentPage'] + 1)}}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      @endif
    </ul>
  </nav>
</div>
@endif