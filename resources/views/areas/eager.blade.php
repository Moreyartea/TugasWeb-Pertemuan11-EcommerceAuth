<x-app-layout title="Demo Eager Loading">
    <x-slot name="header">
        <span class="badge badge-brand">Bonus</span>
        <h1 style="margin-top:10px">Demo Eager Loading</h1>
        <p>Membaca <b>kategori &amp; tag</b> dari {{ $productCount }} produk — lazy loading vs <span class="mono">with()</span>.</p>
    </x-slot>

    <div class="compare">
        <div class="card">
            <span class="badge badge-bad">Tanpa eager loading (N+1)</span>
            <div class="big-n bad-n" style="margin-top:18px">{{ $lazy['queries'] }}</div>
            <div class="muted">query · {{ $lazy['ms'] }} ms</div>
            <pre class="code">Product::all()->each(fn ($p) =>
    $p->category->name   // +1 query per produk
    $p->tags             // +1 query per produk
);</pre>
        </div>
        <div class="card">
            <span class="badge badge-ok">Dengan eager loading</span>
            <div class="big-n good-n" style="margin-top:18px">{{ $eager['queries'] }}</div>
            <div class="muted">query · {{ $eager['ms'] }} ms</div>
            <pre class="code">Product::with(['category', 'tags'])
    ->get();             // 1 + 1 + 2 query</pre>
        </div>
    </div>

    <p class="muted section">
        Hemat <b>{{ $lazy['queries'] - $eager['queries'] }}</b> query
        ({{ $eager['queries'] > 0 ? round($lazy['queries'] / $eager['queries'], 1) : 0 }}× lebih sedikit).
        Etalase toko, dashboard, dan tabel Filament memakai pola eager loading yang sama.
    </p>
</x-app-layout>
