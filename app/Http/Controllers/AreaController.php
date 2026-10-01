<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AreaController extends Controller
{
    /** /admin-area — dilindungi middleware role:admin. */
    public function admin(): View
    {
        return view('areas.admin', [
            'users' => User::withCount('orders')->orderBy('role')->orderBy('name')->get(),
            'roleCounts' => User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role'),
        ]);
    }

    /** /editor-area — dilindungi middleware role:admin,editor. */
    public function editor(): View
    {
        return view('areas.editor', [
            'lowStock' => Product::with('category')->lowStock()->orderBy('stock')->take(8)->get(),
            'recentOrders' => Order::with('user')->latest()->take(6)->get(),
        ]);
    }

    /** Demo bonus: perbandingan jumlah query N+1 vs eager loading. */
    public function eagerLoading(): View
    {
        $measure = function (callable $callback): array {
            DB::flushQueryLog();
            DB::enableQueryLog();
            $start = hrtime(true);
            $callback();
            $ms = (hrtime(true) - $start) / 1e6;
            $queries = count(DB::getQueryLog());
            DB::disableQueryLog();

            return ['queries' => $queries, 'ms' => round($ms, 1)];
        };

        $lazy = $measure(fn () => Product::all()->each(fn ($p) => [$p->category->name, $p->tags->pluck('name')]));
        $eager = $measure(fn () => Product::with(['category', 'tags'])->get()->each(fn ($p) => [$p->category->name, $p->tags->pluck('name')]));

        return view('areas.eager', [
            'lazy' => $lazy,
            'eager' => $eager,
            'productCount' => Product::count(),
        ]);
    }
}
