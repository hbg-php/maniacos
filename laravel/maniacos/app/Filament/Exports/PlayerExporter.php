<?php

namespace App\Filament\Exports;

use app\Enums\Category;
use App\Models\Player;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PlayerExporter extends Exporter
{
    protected static ?string $model = Player::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')->label('Nome'),
            ExportColumn::make('category')
                ->label('Categoria')
                ->getStateUsing(fn ($model): string => Category::getLabelFromValue($model->category)),
            ExportColumn::make('height')->label('Altura'),
            ExportColumn::make('weight')->label('Peso'),
            ExportColumn::make('birthdate')
                ->label('Data de Nascimento')
                ->getStateUsing(fn ($model): string => date('d/m/Y', strtotime($model->birthdate))),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your player export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
