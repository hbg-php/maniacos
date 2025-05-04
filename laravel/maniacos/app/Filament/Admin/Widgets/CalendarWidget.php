<?php

namespace App\Filament\Admin\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public function fetchEvents(array $info): array
    {
        return [];
    }
}
