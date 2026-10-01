<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /** Etalase publik. Relasi di-eager-load agar tidak terjadi N+1 query. */
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with(['category', 'tags'])
            ->when($request->string('q')->trim()->value(), fn ($q, $term) => $q->where('name', 'like', "%{$term}%"))
            ->when($request->integer('category'), fn ($q, $id) => $q->where('category_id', $id))
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('welcome', [
            'products' => $products,
            'categories' => Category::withCount('products')->orderBy('name')->get(),
            'activeCategory' => $request->integer('category') ?: null,
            'search' => $request->string('q')->trim()->value(),
            'totalProducts' => Product::count(),
        ]);
    }
}
