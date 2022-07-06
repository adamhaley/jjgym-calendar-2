<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Checkbox;
use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('contact'),
                TextInput::make('num_people')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5),
                Textarea::make('note')
                    ->cols(20),
                DateTimePicker::make('start')
                    ->displayFormat('F j, Y g:ia')
                    ->withoutSeconds(),
                DateTimePicker::make('end')
                    ->displayFormat('F j, Y g:ia')
                    ->withoutSeconds(),
                Checkbox::make('approved')
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('approved')
                    ->label('Approved')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact')
                    ->label('Contact')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start')
                    ->label('Start Time')
                    ->dateTime('F j g:ia')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end')
                    ->label('End Time')
                    ->dateTime('F j g:ia')
                    ->sortable(),
            ])
            ->defaultSort('id','desc')
            ->filters([
                //
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
