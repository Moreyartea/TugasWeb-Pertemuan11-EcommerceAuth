<section>
    <header>
        <h2 style="font-size:18px; color: var(--bad)">Hapus akun</h2>
        <p class="muted small" style="margin-top:4px">Setelah dihapus, seluruh data akun akan hilang permanen. Unduh data yang ingin kamu simpan terlebih dahulu.</p>
    </header>

    <div style="margin-top:18px">
        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" type="button">Hapus akun</x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="card-pad">
            @csrf
            @method('delete')

            <h2 style="font-size:19px">Yakin ingin menghapus akun?</h2>
            <p class="muted small" style="margin-top:8px">Masukkan password untuk mengonfirmasi bahwa kamu ingin menghapus akun secara permanen.</p>

            <div style="margin-top:18px">
                <x-input-label for="password" value="Password" class="sr-only" style="position:absolute;left:-9999px" />
                <x-text-input id="password" name="password" type="password" placeholder="Password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="row" style="justify-content:flex-end; margin-top:22px">
                <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                <x-danger-button>Ya, hapus akun</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
