<section>
    <header>
        <h2 style="font-size:18px">Ubah password</h2>
        <p class="muted small" style="margin-top:4px">Gunakan password yang panjang dan acak agar akun tetap aman.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="form-grid" style="margin-top:22px">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Password saat ini" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>
        <div>
            <x-input-label for="update_password_password" value="Password baru" />
            <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>
        <div>
            <x-input-label for="update_password_password_confirmation" value="Ulangi password baru" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="row">
            <x-primary-button>Simpan</x-primary-button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)" class="small" style="color:var(--ok);font-weight:700">✓ Tersimpan</p>
            @endif
        </div>
    </form>
</section>
