<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VacancyResource\Pages;
use App\Filament\Resources\VacancyResource\RelationManagers;
use App\Models\Vacancy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VacancyResource extends Resource
{
    protected static ?string $model = Vacancy::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('year_id')
                    ->relationship('year', 'name')
                    ->required(),
                Forms\Components\TextInput::make('adv_number')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('service')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sub_service')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sup_service')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('post')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qualification')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_demand')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('min_date_to_pay')
                    ->required(),
                Forms\Components\DatePicker::make('double_date_to_pay')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('adv_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sup_service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post')
                    ->searchable(),
                Tables\Columns\TextColumn::make('qualification')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_demand')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('min_date_to_pay')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('double_date_to_pay')
                    ->date()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVacancies::route('/'),
            'create' => Pages\CreateVacancy::route('/create'),
            'view' => Pages\ViewVacancy::route('/{record}'),
            'edit' => Pages\EditVacancy::route('/{record}/edit'),
        ];
    }
}
