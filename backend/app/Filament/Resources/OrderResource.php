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
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
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
                    ->date(),
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
                    ])->sortable(),
                TextColumn::make('id')
                    ->label('Sifariş kodu')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Sifarişin tarixi')
                    ->dateTime('d-M-Y h:m')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Dəyişmə vaxtı')
                    ->dateTime('d-M h:m')
                    ->sortable(),
                TextColumn::make('customer.phone')
                    ->label('Əlaqə')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'canceled' => 'Canceled',
                    ]),

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
            ->orderBy('created_at', 'DESC')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    protected static ?string $pluralModelLabel = 'Sifarişlər';


}
