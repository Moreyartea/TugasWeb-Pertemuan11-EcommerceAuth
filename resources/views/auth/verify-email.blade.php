<x-guest-layout title="Verifikasi Email">
    <h1>Cek emailmu 📬</h1>
    <p class="sub">Terima kasih sudah mendaftar! Klik tautan verifikasi yang kami kirim ke emailmu. Belum menerima? Kami bisa kirim ulang.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert" style="margin-bottom:16px">Tautan verifikasi baru sudah dikirim ke emailmu.</div>
    @endif

    <div class="row row-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>Kirim ulang email</x-primary-button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-ghost">Keluar</button>
        </form>
    </div>
</x-guest-layout>
