<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class TodayOrdersWidget extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
       return Order::where('date', Carbon::today());

    }


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('customer.name')
                ->label('Müştəri adı') ,
            TextColumn::make('id')
                ->label('Sifariş kodu'),
            BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'approved',
                    'secondary' => 'pending',
                    'danger' => 'canceled',

                ]),
        ];
    }
}
