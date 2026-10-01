<x-guest-layout title="Lupa Password">
    <h1>Lupa password?</h1>
    <p class="sub">Masukkan email akunmu dan kami kirimkan tautan untuk mengatur ulang password.</p>

    <x-auth-session-status :status="session('status')" style="margin-bottom:16px" />

    <form method="POST" action="{{ route('password.email') }}" class="form-grid">
        @csrf
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>
        <x-primary-button class="btn btn-primary btn-block">Kirim tautan reset</x-primary-button>
    </form>

    <p class="auth-foot"><a href="{{ route('login') }}">← Kembali ke halaman masuk</a></p>
</x-guest-layout>
