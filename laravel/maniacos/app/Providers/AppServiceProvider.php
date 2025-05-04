<?php

namespace App\Providers;

use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Filament\Resources\Pages\CreateRecord::disableCreateAnother();
        CreateAction::configureUsing(fn(CreateAction $action) => $action->createAnother(false));
    }
}
