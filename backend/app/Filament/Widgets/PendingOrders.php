<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\CustomerResource\RelationManagers\OrdersRelationManager;
use App\Models\Customer;
use App\Models\Order;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendingOrders extends BaseWidget
{
    //protected static ?string $pluralWidgetLabel = 'Gözləyən Sifarişlər';

    protected int|string|array $columnSpan = 'full';



    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('view')
            ->url(fn(Order $record): string => route('filament.resources.orders.edit', $record)),
        ];
    }

    protected function getTableQuery(): Builder
    {

        return Order::query()->where('status', 'pending')
            ->orderBy('date', 'ASC');
    }

    protected function getTableColumns(): array
    {

        return [
            SpatieMediaLibraryImageColumn::make('Şəkil')->collection('order-photo'),
            TextColumn::make('date')
                ->label('Tarix')
                ->date('d-M'),
            TextColumn::make('customer.name')
                ->label('Müştəri adı')
                ->searchable(),
            Tables\Columns\SelectColumn::make('status')
                ->label('Statusu')
                ->options([
                    'approved' => 'approved',
                    'pending' => 'pending',
                    'rejected' => 'rejected',
                    'canceled' => 'canceled',
                ])
                ->sortable(),
            TextColumn::make('id')
                ->label('Sifariş kodu')
                ->searchable()
                ->url(fn(Order $record): string => route('filament.resources.orders.edit', $record)),

            TextColumn::make('customer.phone')
                ->label('Əlaqə')
                ->searchable(),
        ];
    }


    protected function getTableFilters(): array
    {
        return [
            Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from'),
                    DatePicker::make('created_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
        ];
    }





}
