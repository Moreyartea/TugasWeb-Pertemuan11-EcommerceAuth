<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return response()->json([
            'message' => 'Anda diizinkan mengedit post ini.',
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $post->update($data);

        return response()->json([
            'message' => 'Post berhasil diperbarui.',
            'post' => $post,
        ]);
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post berhasil dihapus.',
        ]);
    }
}