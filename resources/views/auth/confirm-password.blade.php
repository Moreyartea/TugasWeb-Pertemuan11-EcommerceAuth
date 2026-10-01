<x-guest-layout title="Konfirmasi Password">
    <h1>Area aman 🔒</h1>
    <p class="sub">Konfirmasi password kamu sebelum melanjutkan.</p>

    <form method="POST" action="{{ route('password.confirm') }}" class="form-grid">
        @csrf
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>
        <x-primary-button class="btn btn-primary btn-block">Konfirmasi</x-primary-button>
    </form>
</x-guest-layout>
