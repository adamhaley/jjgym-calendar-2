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
        return Order::query()->latest()->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\Boolean::make('events.pending')
                ->label('Pending'),
            Tables\Columns\TextColumn::make('events.title')
                ->label('Title'),
            Tables\Columns\TextColumn::make('events.start')
                ->label('Start Time'),
            Tables\Columns\TextColumn::make('events.end')
                ->label('End Time'),

        ];
    }
}
