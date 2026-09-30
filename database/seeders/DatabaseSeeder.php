<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        OrderItem::truncate();
        Order::truncate();
        DB::table('product_tag')->truncate();
        Product::truncate();
        Tag::truncate();
        Category::truncate();
        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $categories = Category::factory()
            ->count(10)
            ->create();

        $tags = Tag::factory()
            ->count(10)
            ->create();

        $products = Product::factory()
            ->count(60)
            ->create([
                'category_id' => fn () => $categories->random()->id,
            ]);

        $products->each(function (Product $product) use ($tags) {
            $product->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $users = collect([
            [
                'name' => 'Admin E-Commerce',
                'email' => 'admin@example.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Editor E-Commerce',
                'email' => 'editor@example.com',
                'role' => 'editor',
            ],
            [
                'name' => 'User E-Commerce',
                'email' => 'user@example.com',
                'role' => 'user',
            ],
        ])->map(function (array $user) {
            return User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        });

        foreach ($users as $user) {
            $orders = Order::factory()
                ->count(7)
                ->create([
                    'user_id' => $user->id,
                ]);

            foreach ($orders as $order) {
                $total = 0;

                $itemCount = rand(2, 5);

                for ($i = 0; $i < $itemCount; $i++) {
                    $product = $products->random();
                    $quantity = rand(1, 4);

                    $item = OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ]);

                    $total += $item->price * $item->quantity;
                }

                $order->update([
                    'total_amount' => $total,
                ]);
            }
        }
    }
}