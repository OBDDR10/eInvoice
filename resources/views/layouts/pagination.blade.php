<ul class="pagination">
    <li class="page-item">
      <a class="page-link rounded-0" href="{{ $data->previousPageUrl() }}"><</a>
    </li>

    @foreach ($data as $page => $url)
      @if($page > 0 && $page <=  ceil($data->total()/$entries))
        <li class="page-item">
            <a class="page-link rounded-0" id="page_{{$page}}" href="{{ $data->url($page) }}">{{ $page }}</a>
        </li>
      @endif
    @endforeach

    <li class="page-item">
      <a class="page-link rounded-0" href="{{ $data->nextPageUrl() }}">></a>
    </li>
</ul>