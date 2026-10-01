<x-app-layout title="Konten">
    <x-slot name="header">
        <div class="row row-between">
            <div>
                <span class="badge badge-brand">PostPolicy</span>
                <h1 style="margin-top:10px">Konten</h1>
                <p>Admin boleh mengelola semua post. Editor hanya post miliknya sendiri.</p>
            </div>
        </div>
    </x-slot>

    @if (session('status')) <div class="alert" style="margin-bottom:18px">{{ session('status') }}</div> @endif

    <div class="card">
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Judul</th><th>Penulis</th><th>Dibuat</th><th class="num">Aksi</th></tr></thead>
                <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td style="max-width:420px"><b>{{ $post->title }}</b><div class="small muted">{{ \Illuminate\Support\Str::limit($post->content, 90) }}</div></td>
                        <td>{{ $post->user->name }}
                            @if ($post->user_id === auth()->id()) <span class="badge badge-ok">Milikmu</span> @endif
                        </td>
                        <td class="muted">{{ $post->created_at->translatedFormat('d M Y') }}</td>
                        <td class="num">
                            @can('update', $post)
                                <div class="row" style="justify-content:flex-end; gap:8px; flex-wrap:nowrap">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-ghost btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Hapus post ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            @else
                                <span class="badge">🔒 Hanya baca</span>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4"><div class="empty"><div class="big">✍️</div><b>Belum ada post</b></div></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
