<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

/**
 * Aturan otorisasi Post:
 *  - admin  : boleh mengubah / menghapus semua post
 *  - editor : hanya post miliknya sendiri
 *  - user   : tidak boleh
 */
class PostPolicy
{
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin()
            || ($user->isEditor() && $post->user_id === $user->id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->update($user, $post);
    }
}
