<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{

    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('customer_id')
                ->relationship('customer', 'name')
                    ->label('Müştəri adı')
                    ->searchable()
                    ->placeholder('Müştərini Seçin'),
                Forms\Components\TextInput::make('total')
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

                Forms\Components\TextInput::make('beh')
                    ->placeholder('Beh verilibsə qeyd edin ₼'),

                Forms\Components\DatePicker::make('date')
                    ->placeholder('Sifarişin Tarixini seçin')
                    ->required(),
                Forms\Components\TimePicker::make('time')
                    ->withoutSeconds()
                    ->placeholder('Sifarişin Saatını seçin')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('image')->collection('order-photo')
                    ->multiple(),

                Forms\Components\Textarea::make('description')
                    ->placeholder('Əlavə Bütün qeydlərinizi yazın'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //SpatieMediaLibraryImageColumn::make('image')->collection('order-photo'),
                Tables\Columns\TextColumn::make('id')
                    ->label('Sifariş kodu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Müştəri adı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.phone')
                    ->label('Əlaqə')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statusu')
                    ->colors([
                        'primary' => 'approved',
                        'secondary' => 'pending',
                        'warning' => 'rejected',
                        'success' => 'approved',
                        'danger' => 'canceled',
                    ])->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tarix')
                    ->date(),



            ])
            ->filters([
                //Tables\Filters\TrashedFilter::make(),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'canceled' => 'Canceled',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            ->orderBy('date', 'ASC')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    protected static ?string $pluralModelLabel = 'Sifarişlər';

    public function isTableRecordSelectable(): ?Closure
    {
        return fn (Model $record): bool => $record->status === Status::Enabled;
    }

}
