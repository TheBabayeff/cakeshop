<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TotalOrdersWidget extends BaseWidget
{

    protected int|string|array $columnSpan = 'full';


    protected function getCards(): array
    {
            return [
                Card::make('Sifarişlər', Order::count()),
                Card::make('Ümumi Müştəri', Customer::count()),
                Card::make('Gözləyən Sifariş', Order::where('status', 'pending')->count()),
                Card::make('Bu günə olan sifariş', Order::where('date', Carbon::today())->count()),
                Card::make('Bu Ay üçün olan sifariş', Order::where('date', Carbon::shouldOverflowMonths())->count()),
            ];
    }


}
