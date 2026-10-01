<x-app-layout title="Beranda">
    <section class="hero">
        <div class="container">
            <div>
                <span class="eyebrow"><i></i> {{ $totalProducts }} produk siap dikirim</span>
                <h1>Temukan produk favoritmu, <em>aman &amp; praktis.</em></h1>
                <p class="lead">Dari gadget hingga kopi pilihan — belanja di satu tempat dengan akun yang terlindungi hak akses berbasis peran.</p>
                <div class="row" style="margin-top: 28px">
                    <a href="#katalog" class="btn btn-light">Jelajahi katalog</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light">Buat akun gratis</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Buka dashboard</a>
                    @endguest
                </div>
                <div class="hero-stats">
                    <div><b>{{ $categories->count() }}</b><span>Kategori</span></div>
                    <div><b>{{ $totalProducts }}</b><span>Produk</span></div>
                    <div><b>3</b><span>Level akses</span></div>
                </div>
            </div>
            <div class="hero-art" aria-hidden="true">
                <div class="float-card float-1"><div class="em" style="background:#e8e8ff">🎧</div><div><b>Wireless Earbuds</b><span>Mulai Rp 250.000</span></div></div>
                <div class="float-card float-2"><div class="em" style="background:#ffeadf">☕</div><div><b>Kopi Arabika Gayo</b><span>Terlaris minggu ini</span></div></div>
                <div class="float-card float-3"><div class="em" style="background:#e3f6ec">🏀</div><div><b>Perlengkapan Olahraga</b><span>Gratis ongkir</span></div></div>
            </div>
        </div>
    </section>

    <div class="container search-bar">
        <form method="GET" action="{{ route('home') }}#katalog" class="card search-card">
            @if ($activeCategory) <input type="hidden" name="category" value="{{ $activeCategory }}"> @endif
            <input class="input grow" style="min-width:200px" type="search" name="q" value="{{ $search }}" placeholder="Cari produk, mis. kopi, earbuds, sepatu…">
            <button class="btn btn-primary" type="submit">Cari</button>
            @if ($search || $activeCategory)
                <a class="btn btn-ghost" href="{{ route('home') }}#katalog">Reset</a>
            @endif
        </form>
    </div>

    <div class="container page" id="katalog" style="padding-top: 28px">
        <div class="chips">
            <a href="{{ route('home', array_filter(['q' => $search])) }}#katalog" class="chip {{ $activeCategory ? '' : 'active' }}">Semua</a>
            @foreach ($categories as $category)
                <a href="{{ route('home', array_filter(['q' => $search, 'category' => $category->id])) }}#katalog"
                   class="chip {{ $activeCategory === $category->id ? 'active' : '' }}">
                    {{ $category->emoji }} {{ $category->name }} <small>{{ $category->products_count }}</small>
                </a>
            @endforeach
        </div>

        @if ($products->count())
            <div class="product-grid">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            @if ($products->hasPages())
                <nav class="pager" aria-label="Halaman">
                    @if ($products->onFirstPage())
                        <span class="dis">‹</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}#katalog">‹</a>
                    @endif
                    @foreach ($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                        @if ($page === $products->currentPage())
                            <span class="cur">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}#katalog">{{ $page }}</a>
                        @endif
                    @endforeach
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}#katalog">›</a>
                    @else
                        <span class="dis">›</span>
                    @endif
                </nav>
            @endif
        @else
            <div class="empty card" style="margin-top:22px">
                <div class="big">🔍</div>
                <b>Produk tidak ditemukan</b>
                Coba kata kunci lain atau reset filter.
            </div>
        @endif
    </div>
</x-app-layout>
