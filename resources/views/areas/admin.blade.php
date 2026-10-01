<x-app-layout title="Area Admin">
    <x-slot name="header">
        <span class="badge badge-dark">role:admin</span>
        <h1 style="margin-top:10px">Area Admin</h1>
        <p>Halaman ini hanya bisa dibuka oleh admin. Editor &amp; user akan menerima <b>403 Forbidden</b>.</p>
    </x-slot>

    <div class="grid grid-3">
        @foreach (['admin' => ['🔑', 'Admin'], 'editor' => ['✍️', 'Editor'], 'user' => ['🛍️', 'User']] as $role => [$icon, $label])
            <div class="card stat"><div class="stat-icon">{{ $icon }}</div><div><div class="stat-value">{{ $roleCounts[$role] ?? 0 }}</div><div class="stat-label">{{ $label }}</div></div></div>
        @endforeach
    </div>

    <div class="card section">
        <div class="card-head"><h3>Semua pengguna</h3><span class="small muted">{{ $users->count() }} akun</span></div>
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th class="num">Pesanan</th></tr></thead>
                <tbody>
                @foreach ($users as $u)
                    <tr>
                        <td><div class="row" style="gap:10px"><span class="avatar">{{ mb_strtoupper(mb_substr($u->name, 0, 1)) }}</span><b>{{ $u->name }}</b></div></td>
                        <td class="muted">{{ $u->email }}</td>
                        <td><span class="badge {{ $u->isAdmin() ? 'badge-dark' : ($u->isEditor() ? 'badge-brand' : '') }}">{{ ucfirst($u->role) }}</span></td>
                        <td class="num">{{ $u->orders_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
