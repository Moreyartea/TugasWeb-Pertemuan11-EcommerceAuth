<x-guest-layout title="Daftar">
    <h1>Buat akun baru</h1>
    <p class="sub">Gratis dan hanya butuh satu menit.</p>

    <form method="POST" action="{{ route('register') }}" class="form-grid">
        @csrf
        <div>
            <x-input-label for="name" value="Nama lengkap" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" placeholder="Nama kamu" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="nama@email.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>
        <div>
            <x-input-label for="password_confirmation" value="Ulangi password" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ketik ulang password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>
        <x-primary-button class="btn btn-primary btn-block">Daftar</x-primary-button>
    </form>

    <p class="auth-foot">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
</x-guest-layout>
