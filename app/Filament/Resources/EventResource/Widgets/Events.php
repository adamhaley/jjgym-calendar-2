<?php

namespace App\Filament\Resources\EventResource\Widgets;

use App\Models\Event;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class Events extends BaseWidget
{


    protected function getTableQuery(): Builder
    {
        // ...
        return Event::query()->latest()->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
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
            Tables\Columns\TextColumn::make('start')
                ->label('Start Time')
                ->dateTime('F j g:ia')
                ->sortable(),
        ];
    }


}
