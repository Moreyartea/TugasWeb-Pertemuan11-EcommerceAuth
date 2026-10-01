<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $orders = $user->orders()
            ->with('orderItems.product')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'orders' => $orders,
            'orderCount' => $user->orders()->count(),
            'orderTotal' => (float) $user->orders()->where('status', '!=', 'cancelled')->sum('total_amount'),
            'stats' => $user->hasRole('admin', 'editor') ? [
                'products' => Product::count(),
                'lowStock' => Product::lowStock()->count(),
                'orders' => Order::count(),
                'posts' => Post::count(),
                'users' => $user->isAdmin() ? User::count() : null,
            ] : null,
        ]);
    }
}
