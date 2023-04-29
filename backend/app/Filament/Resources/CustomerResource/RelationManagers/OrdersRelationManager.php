<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'id';
    protected static ?string $pluralModelLabel = 'Sifarişlər';

    protected function canCreate(): bool
    {
        return true;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Tables\Columns\TextColumn::make('id')
                    ->label('Sifariş kodu'),
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
