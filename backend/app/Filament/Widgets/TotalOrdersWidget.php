<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Auth;

class TotalOrdersWidget extends BaseWidget
{

    protected int|string|array $columnSpan = 'full';


    protected function getCards(): array
    {
        if (Auth::user()->is_admin === 1){
            return [
                Card::make('Cəmi Sifariş', Order::count()),
                Card::make('Cəmi Müştəri', Customer::count()),
                Card::make('Gözləyən Sifariş', Order::where('status', 'pending')->count()),
                Card::make('Bu günə olan sifariş', Order::where('date', Carbon::today())->count()),
            ];
        }
        return [

            //Card::make('Cəmi Sifariş', Order::count()),
            Card::make('Gözləyən Sifariş', Order::where('status', 'pending')->count()),
            Card::make('Bu günə olan sifariş', Order::whereDate('date', today())->count()),

        ];
    }


}
