<?php

use App\Models\Post;
use App\Models\User;

function userWithRole(string $role): User
{
    return User::factory()->create(['role' => $role]);
}

it('redirects guests to login for protected routes', function (string $url) {
    $this->get($url)->assertRedirect('/login');
})->with(['/dashboard', '/admin-area', '/editor-area', '/posts', '/demo/eager-loading']);

it('allows only admin into /admin-area', function (string $role, int $status) {
    $this->actingAs(userWithRole($role))->get('/admin-area')->assertStatus($status);
})->with([['admin', 200], ['editor', 403], ['user', 403]]);

it('allows admin and editor into /editor-area', function (string $role, int $status) {
    $this->actingAs(userWithRole($role))->get('/editor-area')->assertStatus($status);
})->with([['admin', 200], ['editor', 200], ['user', 403]]);

it('shows the eager loading demo to staff only', function () {
    $this->actingAs(userWithRole('user'))->get('/demo/eager-loading')->assertForbidden();
    $this->actingAs(userWithRole('editor'))->get('/demo/eager-loading')->assertOk();
});

it('registers new users with the default "user" role', function () {
    $this->post('/register', [
        'name' => 'Pembeli Baru', 'email' => 'baru@example.com',
        'password' => 'password123', 'password_confirmation' => 'password123',
        'role' => 'admin', // upaya privilege escalation harus diabaikan
    ]);

    expect(User::where('email', 'baru@example.com')->value('role'))->toBe('user');
});

describe('PostPolicy', function () {
    it('lets admin update and delete any post', function () {
        $post = Post::factory()->create();
        $admin = userWithRole('admin');

        $this->actingAs($admin)->put("/posts/{$post->id}", ['title' => 'Baru', 'content' => 'Isi'])->assertRedirect('/posts');
        $this->actingAs($admin)->delete("/posts/{$post->id}")->assertRedirect('/posts');
        expect(Post::find($post->id))->toBeNull();
    });

    it('lets an editor change only their own posts', function () {
        $editor = userWithRole('editor');
        $own = Post::factory()->for($editor)->create();
        $other = Post::factory()->create();

        $this->actingAs($editor)->get("/posts/{$own->id}/edit")->assertOk();
        $this->actingAs($editor)->get("/posts/{$other->id}/edit")->assertForbidden();
        $this->actingAs($editor)->delete("/posts/{$other->id}")->assertForbidden();
        expect(Post::find($other->id))->not->toBeNull();
    });

    it('forbids regular users', function () {
        $user = userWithRole('user');
        $post = Post::factory()->for($user)->create();

        $this->actingAs($user)->get("/posts/{$post->id}/edit")->assertForbidden();
        $this->actingAs($user)->delete("/posts/{$post->id}")->assertForbidden();
    });
});

describe('Filament panel', function () {
    it('is reachable by admin and editor but not by user', function () {
        $this->actingAs(userWithRole('admin'))->get('/admin/products')->assertOk();
        $this->actingAs(userWithRole('editor'))->get('/admin/products')->assertOk();
        $this->actingAs(userWithRole('user'))->get('/admin/products')->assertForbidden();
    });
});
