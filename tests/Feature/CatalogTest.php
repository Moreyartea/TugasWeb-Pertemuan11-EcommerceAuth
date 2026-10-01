<?php

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\DatabaseSeeder;

it('seeds at least 50 unique, realistic products with relations', function () {
    $this->seed(DatabaseSeeder::class);

    expect(Product::count())->toBeGreaterThanOrEqual(50)
        ->and(Product::distinct()->count('name'))->toBe(Product::count())
        ->and(Category::count())->toBeGreaterThanOrEqual(5)
        ->and(Product::doesntHave('tags')->count())->toBe(0);
});

it('has working query scopes', function () {
    Product::factory()->create(['stock' => 3, 'price' => 100000]);
    Product::factory()->create(['stock' => 50, 'price' => 900000]);

    expect(Product::lowStock()->count())->toBe(1)
        ->and(Product::priceAbove(500000)->count())->toBe(1);
});

it('renders the public storefront with eager-loaded relations', function () {
    $this->seed(DatabaseSeeder::class);

    $queries = 0;
    DB::listen(function () use (&$queries) { $queries++; });

    $this->get('/')->assertOk()->assertSee('NusaMart');

    // 12 produk per halaman: jumlah query harus konstan (tidak N+1)
    expect($queries)->toBeLessThan(10);
});

it('filters the storefront by category and search', function () {
    $this->seed(DatabaseSeeder::class);
    $category = Category::where('name', 'Elektronik')->first();

    $this->get('/?category='.$category->id)->assertOk()->assertSee('Wireless Earbuds');
    $this->get('/?q=zzzzzz')->assertOk()->assertSee('Produk tidak ditemukan');
});
