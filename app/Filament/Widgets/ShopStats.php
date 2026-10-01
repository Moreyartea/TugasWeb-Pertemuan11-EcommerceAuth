<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ShopStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $revenue = (float) Order::where('status', '!=', 'cancelled')->sum('total_amount');

        return [
            Stat::make('Total Produk', Product::count())
                ->description('Produk aktif di katalog')
                ->color('primary'),
            Stat::make('Stok Menipis', Product::lowStock()->count())
                ->description('Stok ≤ 10 unit')
                ->color('danger'),
            Stat::make('Pendapatan', 'Rp '.number_format($revenue, 0, ',', '.'))
                ->description(Order::count().' pesanan (tanpa yang dibatalkan)')
                ->color('success'),
        ];
    }
}
