<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    @foreach ($breadcrumb as $item)

        @if(!$loop->last)
            <li class="breadcrumb-item"><a href="{{$item['link']}}">{{$item['title']}}</a></li>
            <span class="px-2"> / </span>
        @endif

        @if($loop->last)
            <li class="breadcrumb-item active" aria-current="page">{{$item['title']}}</li>
        @endif
    @endforeach      
    </ol>
</nav>