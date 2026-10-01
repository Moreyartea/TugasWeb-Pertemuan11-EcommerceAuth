<x-guest-layout title="Masuk">
    <h1>Selamat datang kembali 👋</h1>
    <p class="sub">Masuk untuk melanjutkan belanja dan mengelola akunmu.</p>

    <x-auth-session-status :status="session('status')" style="margin-bottom:16px" />

    <form method="POST" action="{{ route('login') }}" class="form-grid">
        @csrf
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="nama@email.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" placeholder="••••••••" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>
        <div class="row row-between">
            <label for="remember_me" class="check"><input id="remember_me" type="checkbox" name="remember"> Ingat saya</label>
            @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}"><b>Lupa password?</b></a>
            @endif
        </div>
        <x-primary-button class="btn btn-primary btn-block">Masuk</x-primary-button>
    </form>

    <p class="auth-foot">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>

    @if (app()->environment('local'))
        <div class="demo-box">
            <b>Akun demo (password: <code>password</code>)</b>
            <div class="demo-row"><span>Admin</span><code>admin@example.com</code></div>
            <div class="demo-row"><span>Editor</span><code>editor@example.com</code></div>
            <div class="demo-row"><span>User</span><code>user@example.com</code></div>
        </div>
    @endif
</x-guest-layout>
