@props(['product'])

<article class="card product">
    <div class="thumb" style="--h: {{ $product->category->hue }}">
        @if ($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" loading="lazy">
        @else
            <span>{{ $product->category->emoji }}</span>
        @endif
        @if ($product->stock === 0)
            <span class="flag badge badge-bad" style="filter:none">Habis</span>
        @elseif ($product->stock <= 10)
            <span class="flag badge badge-warn" style="filter:none">Sisa {{ $product->stock }}</span>
        @endif
    </div>
    <div class="product-body">
        <div class="product-cat">{{ $product->category->name }}</div>
        <h3 class="product-name">{{ $product->name }}</h3>
        <div class="product-tags">
            @foreach ($product->tags->take(2) as $tag)
                <span class="badge">{{ $tag->name }}</span>
            @endforeach
        </div>
        <div class="product-foot">
            <div class="price">{{ $product->price_formatted }}</div>
            <span class="small muted">Stok {{ $product->stock }}</span>
        </div>
    </div>
</article>
