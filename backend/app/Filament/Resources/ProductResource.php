<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $pluralModelLabel = 'Məhsullar';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('name')
                    ->afterStateUpdated(function (Closure $get, Closure $set, ?string $state) {
                        if (! $get('is_slug_changed_manually') && filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->reactive()
                    ->required(),
                TextInput::make('slug')
                    ->disabled()
                    ->afterStateUpdated(function (Closure $set) {
                        $set('is_slug_changed_manually', true);
                    })
                    ->required(),
                Hidden::make('is_slug_changed_manually')
                    ->default(false)
                    ->dehydrated(false),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required()
                    ->label('Kateqoriya adı')
                    ->placeholder('Kateqoriya Seçin')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->afterStateUpdated(function (Closure $get, Closure $set, ?string $state) {
                                if (! $get('is_slug_changed_manually') && filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->reactive()
                            ->required(),
                        TextInput::make('slug')
                            ->afterStateUpdated(function (Closure $set) {
                                $set('is_slug_changed_manually', true);
                            })
                            ->disabled()
                            ->required(),
                        Forms\Components\FileUpload::make('image'),
                    ])
                    ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                        return $action
                            ->modalHeading('Kateqoriya yarat')
                            ->modalButton('Create category')
                            ->modalWidth('lg');
                    }),
                Forms\Components\TextInput::make('price')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535),
//                Forms\Components\FileUpload::make('preview_image')
//                    ->label('Əsas Şəkil')
//                    ->columns(1)
//                    ->directory('products'),
                Forms\Components\Section::make('Şəkil')
                    ->schema([
                        Forms\Components\FileUpload::make('preview_image')
                            ->label('Əsas şəkil'),
                        Forms\Components\FileUpload::make('product_images')
                            ->label('Digər şəkillər')
                            ->columns(1)
                            ->multiple()
                            ->directory('products')
                            ->storeFileNamesIn('original_filename')
                            ->enableReordering(),
                    ])
                    ->collapsible()
                    ->default('false'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\ImageColumn::make('product_images')->square(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->searchable(),
                Tables\Columns\TextColumn::make('price'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
