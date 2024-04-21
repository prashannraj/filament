<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\Service;
use App\Models\SubService;
use App\Models\SupService;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('service_id')
                    ->options(Service::all()->pluck('name', 'id'))
                    ->label('Select Service')
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('sub_service_id', null)),
                Select::make('sub_service_id')
                    ->options(function (callable $get) {
                        $service = Service::find($get('service_id'));
                        if (!$service) {
                            return SubService::all()->pluck('name', 'id');
                        }
                        return $service->sub_services->pluck('name', 'id');
                    })
                    ->label('Select Sub Service')
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('sup_service_id', null)),
                Select::make('sup_service')
                    ->relationship('sup_service', 'name')
                    ->options(function (callable $get) {
                        $sub_service = SubService::find($get('sub_service_id'));
                        if (!$sub_service) {
                            return SupService::all()->pluck('name', 'id');
                        }
                        return $sub_service->sup_services->pluck('name', 'id');
                    })
                    ->label('Select Sup Service')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('name')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sub_service.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sup_service.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // SubServiceRelationManager::class,
            // SupServiceRelationManager::class,
            // PostRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
