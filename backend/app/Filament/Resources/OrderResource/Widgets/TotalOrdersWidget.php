<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Carbon;

class TotalOrdersWidget extends BaseWidget
{
    protected function getCards(): array
    {

        $gecenAyBaslangic = Carbon::now()->subMonth()->startOfMonth();
        $gecenAyBitis = Carbon::now()->subMonth()->endOfMonth();
        $gecenAySiparisler = Order::whereBetween('created_at', [$gecenAyBaslangic, $gecenAyBitis])->count();


        return [

            Card::make('Keçmiş ay sifarişləri', $gecenAySiparisler),
            Card::make('Ümumi Sifarişlər', Order::count()),
            Card::make('Cəmi məbləğ', number_format(Order::sum('total'))),
        ];
    }
}
