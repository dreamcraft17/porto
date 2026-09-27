@props([
    'trail' => [],
])

<header class="case-head">
    <a href="{{ url('/') }}"><i class="fas fa-arrow-left" aria-hidden="true"></i> Home</a>
    @if(count($trail))
        <nav class="case-crumb" aria-label="Breadcrumb">
            @foreach($trail as $index => $item)
                @if($index > 0)
                    <span aria-hidden="true">/</span>
                @endif
                @if(!empty($item['url']))
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                @else
                    <span aria-current="page">{{ $item['label'] }}</span>
                @endif
            @endforeach
        </nav>
    @endif
</header>
