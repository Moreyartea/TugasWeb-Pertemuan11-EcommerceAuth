<x-app-layout title="Edit Post">
    <x-slot name="header">
        <a href="{{ route('posts.index') }}" class="small">← Kembali ke konten</a>
        <h1 style="margin-top:10px">Edit post</h1>
    </x-slot>

    <form method="POST" action="{{ route('posts.update', $post) }}" class="card card-pad form-grid" style="max-width:720px">
        @csrf @method('PUT')
        <div>
            <x-input-label for="title" value="Judul" />
            <x-text-input id="title" name="title" :value="old('title', $post->title)" required />
            <x-input-error :messages="$errors->get('title')" />
        </div>
        <div>
            <x-input-label for="content" value="Isi konten" />
            <textarea id="content" name="content" class="input" required>{{ old('content', $post->content) }}</textarea>
            <x-input-error :messages="$errors->get('content')" />
        </div>
        <div class="row">
            <x-primary-button>Simpan perubahan</x-primary-button>
            <a href="{{ route('posts.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</x-app-layout>
