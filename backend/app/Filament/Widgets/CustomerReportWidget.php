<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
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

class CustomerReportWidget extends BaseWidget
{
    public function title()
    {
        return 'Keçən ay 1-dən artıq sifariş edən müştərilər';
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->url(fn(Customer $record): string => route('filament.resources.customers.edit', $record)),
        ];
    }
    protected function getTableQuery(): Builder
    {


        return Customer::query()
            ->whereHas('orders', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])
                    ->groupBy('customer_id')
                    ->havingRaw('COUNT(*) >= 2');
            });

    }


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('Müştəri adı') ,
            Tables\Columns\TextColumn::make('Customer Orders count')
                ->label('Sifarişləri')
                ->getStateUsing(function(Customer $record) {
                    // return whatever you need to show
                    return $record->orders()->count();
                })
            ,
        ];
    }
}
