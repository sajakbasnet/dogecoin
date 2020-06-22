<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    @foreach($breadcrumbs as $breadcrumb)
    <li class="breadcrumb-item {{ isset($breadcrumb['active']) ? 'active' : '' }}">
      @if(isset($breadcrumb['active']))
        {{ trans($breadcrumb['title']) }}
      @else
        <a href="{{ $breadcrumb['link']?? '' }}">{{ $breadcrumb['title'] ?? '' }}</a>
      @endif
    </li>
    @endforeach
  </ol>
</nav>
