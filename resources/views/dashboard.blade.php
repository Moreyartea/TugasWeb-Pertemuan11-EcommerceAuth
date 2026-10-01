@php
    $user = auth()->user();
    $statusBadge = fn ($s) => match ($s) {
        'completed' => 'badge-ok', 'processing' => 'badge-brand', 'cancelled' => 'badge-bad', default => 'badge-warn',
    };
    $statusLabel = ['pending' => 'Menunggu', 'processing' => 'Diproses', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'];
@endphp
<x-app-layout title="Dashboard">
    <div class="container page" style="padding-top: 32px">
        <div class="welcome">
            <div>
                <span class="role-pill">● {{ $user->role }}</span>
                <h1>Halo, {{ $user->name }} 👋</h1>
                <p>Berikut ringkasan akunmu hari ini.</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-light">Lanjut belanja →</a>
        </div>

        <div class="grid grid-4 section">
            @if ($stats)
                <div class="card stat"><div class="stat-icon">📦</div><div><div class="stat-value">{{ $stats['products'] }}</div><div class="stat-label">Total produk</div></div></div>
                <div class="card stat"><div class="stat-icon" style="background:var(--warn-50)">⚠️</div><div><div class="stat-value">{{ $stats['lowStock'] }}</div><div class="stat-label">Stok menipis</div></div></div>
                <div class="card stat"><div class="stat-icon" style="background:var(--ok-50)">🧾</div><div><div class="stat-value">{{ $stats['orders'] }}</div><div class="stat-label">Semua pesanan</div></div></div>
                <div class="card stat"><div class="stat-icon">✍️</div><div><div class="stat-value">{{ $stats['posts'] }}</div><div class="stat-label">Post konten</div></div></div>
            @else
                <div class="card stat"><div class="stat-icon">🧾</div><div><div class="stat-value">{{ $orderCount }}</div><div class="stat-label">Pesanan saya</div></div></div>
                <div class="card stat"><div class="stat-icon" style="background:var(--ok-50)">💳</div><div><div class="stat-value">Rp {{ number_format($orderTotal, 0, ',', '.') }}</div><div class="stat-label">Total belanja</div></div></div>
            @endif
        </div>

        <h3 class="section" style="font-size:16px">Akses cepat</h3>
        <div class="quick" style="margin-top:12px">
            <a href="{{ route('home') }}"><span class="stat-icon">🛍️</span><div><b>Katalog produk</b><span>Semua pengguna</span></div></a>
            <a href="{{ route('profile.edit') }}"><span class="stat-icon">👤</span><div><b>Profil saya</b><span>Ubah data &amp; password</span></div></a>
            @if ($user->hasRole('admin', 'editor'))
                <a href="{{ route('posts.index') }}"><span class="stat-icon">✍️</span><div><b>Kelola konten</b><span>Dilindungi PostPolicy</span></div></a>
                <a href="{{ route('editor.area') }}"><span class="stat-icon">🛠️</span><div><b>Area editor</b><span>role: admin, editor</span></div></a>
                <a href="/admin"><span class="stat-icon">🧩</span><div><b>Panel Filament</b><span>Kelola produk</span></div></a>
            @endif
            @if ($user->isAdmin())
                <a href="{{ route('admin.area') }}"><span class="stat-icon">🔑</span><div><b>Area admin</b><span>role: admin saja</span></div></a>
            @endif
        </div>

        <div class="card section">
            <div class="card-head"><h3>Pesanan terbaru</h3><span class="small muted">5 terakhir</span></div>
            @if ($orders->isEmpty())
                <div class="empty"><div class="big">🧾</div><b>Belum ada pesanan</b>Pesananmu akan tampil di sini.</div>
            @else
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th>No.</th><th>Item</th><th>Status</th><th>Tanggal</th><th class="num">Total</th></tr></thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="mono">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    {{ $order->orderItems->first()?->product?->name }}
                                    @if ($order->orderItems->count() > 1)
                                        <span class="muted small">+{{ $order->orderItems->count() - 1 }} lainnya</span>
                                    @endif
                                </td>
                                <td><span class="badge {{ $statusBadge($order->status) }}">{{ $statusLabel[$order->status] ?? $order->status }}</span></td>
                                <td class="muted">{{ $order->created_at->translatedFormat('d M Y') }}</td>
                                <td class="num"><b>{{ $order->total_formatted }}</b></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
