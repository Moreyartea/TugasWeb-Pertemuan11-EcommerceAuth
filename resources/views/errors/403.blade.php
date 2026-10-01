<x-app-layout title="403">
    <div class="container page">
        <div class="empty card" style="margin-top:60px; padding:72px 20px">
            <div class="big">🔒</div>
            <span class="badge badge-dark" style="margin-top:14px">403</span>
            <b style="font-size:24px; margin-top:14px">Akses ditolak</b>
            <p style="max-width:420px; margin:0 auto 24px">Role akunmu tidak memiliki izin untuk membuka halaman ini.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke beranda</a>
        </div>
    </div>
</x-app-layout>
