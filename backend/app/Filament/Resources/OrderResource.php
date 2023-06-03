<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\Widgets\TotalOrdersWidget;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class OrderResource extends Resource
{

    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationBadge(): ?string
    {
        return static::$model::where('status', 'pending')->count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->required()
                    ->label('Müştəri adı')
                    ->placeholder('Müştərini Seçin')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('phone'),
                    ])
                    ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                        return $action
                            ->modalHeading('Müştəri yarat')
                            ->modalButton('Create customer')
                            ->modalWidth('lg');
                    }),


                TextInput::make('total')
                    ->label('Sifarişin Qiyməti')
                    ->placeholder('Sifarişin qiymətini yazın ₼')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'canceled' => 'Canceled',
                    ])
                    ->placeholder('Sifarişin statusunu seçin'),

                TextInput::make('beh')
                    ->placeholder('Beh verilibsə qeyd edin ₼'),

                Forms\Components\DatePicker::make('date')
                    ->placeholder('Sifarişin Tarixini seçin')
                    ->required(),

                Forms\Components\TimePicker::make('time')
                    ->withoutSeconds()
                    ->placeholder('Sifarişin Saatını seçin')
                    ->required(),

                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('order-photo')
                    ->multiple(),

                Forms\Components\Textarea::make('description')
                    ->placeholder('Əlavə Bütün qeydlərinizi yazın'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Tarix')
                    ->date()
                    ->toggleable(),
                TextColumn::make('customer.name')
                    ->label('Müştəri adı')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Statusu')
                    ->options([
                        'approved' => 'approved',
                        'pending' => 'pending',
                        'rejected' => 'rejected',
                        'canceled' => 'canceled',
                    ])
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('id')
                    ->label('Sifariş kodu')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('total')
                    ->label('Qiymət')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Sifarişin tarixi')
                    ->dateTime('d-M-Y h:m')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label('Dəyişmə vaxtı')
                    ->dateTime('d-M h:m')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('customer.phone')
                    ->label('Əlaqə')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'pending',
                        'approved' => 'approved',
                    ]),
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
                    }),

                Filter::make('date')
                    ->form([
                        DatePicker::make('delivered_from'),
                        DatePicker::make('delivered_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['delivered_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['delivered_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['delivered_from'] ?? null) {
                            $indicators['delivered_from'] = 'Order from ' . Carbon::parse($data['delivered_from'])->toFormattedDateString();
                        }
                        if ($data['delivered_until'] ?? null) {
                            $indicators['delivered_until'] = 'Order until ' . Carbon::parse($data['delivered_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function () {
                        Notification::make()
                            ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                            ->warning()
                            ->send();
                    }),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getWidgets(): array
    {
        return [
            TotalOrdersWidget::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            //->where('status', 'pending')
            ->orderBy('created_at', 'DESC')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    protected static ?string $pluralModelLabel = 'Daxili Sifarişlər';

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
