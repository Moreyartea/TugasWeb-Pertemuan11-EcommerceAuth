<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\CategoryFactory;
use Database\Factories\TagFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /** Jumlah produk yang di-seed (syarat tugas: minimal 50). */
    private const PRODUCT_COUNT = 64;

    public function run(): void
    {
        $this->resetTables();

        // Kategori & tag memakai daftar tetap agar data terlihat realistis.
        $categories = collect(CategoryFactory::CATALOG)->map(
            fn (string $description, string $name) => Category::create(compact('name', 'description'))
        )->values();

        $tags = collect(TagFactory::NAMES)->map(
            fn (string $name) => Tag::create(['name' => $name])
        );

        $products = Product::factory()->count(self::PRODUCT_COUNT)->create();

        $products->each(fn (Product $product) => $product->tags()->attach(
            $tags->random(rand(1, 3))->pluck('id')->all()
        ));

        $users = $this->seedUsers();
        $this->seedOrders($users, $products);
        $this->seedPosts($users);
    }

    /** Kosongkan tabel dengan cara yang aman untuk SQLite maupun MySQL. */
    private function resetTables(): void
    {
        Schema::disableForeignKeyConstraints();

        foreach (['order_items', 'orders', 'product_tag', 'posts', 'products', 'tags', 'categories', 'users'] as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();
    }

    /** @return \Illuminate\Support\Collection<string, User> keyed by short name */
    private function seedUsers()
    {
        return collect([
            'admin' => ['Admin E-Commerce', 'admin@example.com', 'admin'],
            'editor' => ['Editor E-Commerce', 'editor@example.com', 'editor'],
            'editor2' => ['Editor Kedua', 'editor2@example.com', 'editor'],
            'user' => ['User E-Commerce', 'user@example.com', 'user'],
        ])->map(fn (array $u) => User::create([
            'name' => $u[0],
            'email' => $u[1],
            'role' => $u[2],
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]));
    }

    private function seedOrders($users, $products): void
    {
        foreach ($users as $user) {
            Order::factory()->count(6)->create(['user_id' => $user->id])->each(function (Order $order) use ($products) {
                $total = 0;

                foreach ($products->random(rand(2, 4)) as $product) {
                    $item = OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity = rand(1, 3),
                        'price' => $product->price,
                    ]);
                    $total += $product->price * $quantity;
                }

                $order->update(['total_amount' => $total]);
            });
        }
    }

    private function seedPosts($users): void
    {
        Post::factory()->count(2)->create(['user_id' => $users['admin']->id]);
        Post::factory()->count(3)->create(['user_id' => $users['editor']->id]);
        Post::factory()->count(2)->create(['user_id' => $users['editor2']->id]);
    }
}
