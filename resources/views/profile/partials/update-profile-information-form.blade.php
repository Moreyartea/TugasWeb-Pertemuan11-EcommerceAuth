<section>
    <header>
        <h2 style="font-size:18px">Informasi profil</h2>
        <p class="muted small" style="margin-top:4px">Perbarui nama dan alamat email akunmu.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}" class="form-grid" style="margin-top:22px">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nama" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top:8px">
                    <p class="small">Email belum terverifikasi.
                        <button form="send-verification" class="small" style="background:none;border:0;color:var(--brand);font-weight:700;cursor:pointer">Kirim ulang email verifikasi</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="small" style="color:var(--ok);font-weight:600">Tautan verifikasi baru sudah dikirim.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="row">
            <x-primary-button>Simpan</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)" class="small" style="color:var(--ok);font-weight:700">✓ Tersimpan</p>
            @endif
        </div>
    </form>
</section>
