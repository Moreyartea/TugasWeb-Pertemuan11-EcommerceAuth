<x-app-layout title="Area Editor">
    <x-slot name="header">
        <span class="badge badge-brand">role:admin,editor</span>
        <h1 style="margin-top:10px">Area Editor</h1>
        <p>Dapat diakses admin dan editor. User biasa akan menerima <b>403 Forbidden</b>.</p>
    </x-slot>

    <div class="quick">
        <a href="{{ route('posts.index') }}"><span class="stat-icon">✍️</span><div><b>Kelola konten</b><span>Edit / hapus via PostPolicy</span></div></a>
        <a href="/admin/products"><span class="stat-icon">🧩</span><div><b>Produk di Filament</b><span>CRUD katalog</span></div></a>
        <a href="{{ route('demo.eager') }}"><span class="stat-icon">⚡</span><div><b>Demo eager loading</b><span>N+1 vs with()</span></div></a>
    </div>

    <div class="grid grid-2 section">
        <div class="card">
            <div class="card-head"><h3>⚠️ Stok menipis</h3><span class="small muted">scope lowStock()</span></div>
            <table class="table">
                <tbody>
                @forelse ($lowStock as $p)
                    <tr>
                        <td><b>{{ $p->name }}</b><div class="small muted">{{ $p->category->name }}</div></td>
                        <td class="num"><span class="badge {{ $p->stock === 0 ? 'badge-bad' : 'badge-warn' }}">{{ $p->stock }} unit</span></td>
                    </tr>
                @empty
                    <tr><td class="muted">Semua stok aman 🎉</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card">
            <div class="card-head"><h3>🧾 Pesanan terbaru</h3></div>
            <table class="table">
                <tbody>
                @foreach ($recentOrders as $o)
                    <tr>
                        <td><b>#{{ str_pad($o->id, 4, '0', STR_PAD_LEFT) }}</b><div class="small muted">{{ $o->user->name }}</div></td>
                        <td class="num">{{ $o->total_formatted }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
