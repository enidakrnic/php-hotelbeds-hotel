<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\AccommodationImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\BoardImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\CategoryImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\ChainImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\ClassificationImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\CurrencyImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\ImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\LanguageImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\InstallCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Accommodation;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Board;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Category;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Chain;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Classification;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Currency;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Description;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Language;

class HotelbedsHotelServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AccommodationImportCommand::class,
                BoardImportCommand::class,
                CategoryImportCommand::class,
                ChainImportCommand::class,
                ClassificationImportCommand::class,
                CurrencyImportCommand::class,
                InstallCommand::class,
                ImportCommand::class,
                LanguageImportCommand::class
            ]);

            $this->publishes([
                __DIR__.'/../../config/hotelbeds-hotel.php' => config_path('hotelbeds-hotel.php'),
            ], 'config');

            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        }
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/hotelbeds-hotel.php', 'hotelbeds-hotel');

        $this->app->singleton(Client::class, function () {
            return new Client(
                config('hotelbeds-hotel.api_key'),
                config('hotelbeds-hotel.secret'),
                config('hotelbeds-hotel.environment')
            );
        });

        Relation::morphMap([
            config('hotelbeds-hotel.table_names.accommodations') => Accommodation::class,
            config('hotelbeds-hotel.table_names.boards') => Board::class,
            config('hotelbeds-hotel.table_names.categories') => Category::class,
            config('hotelbeds-hotel.table_names.chains') => Chain::class,
            config('hotelbeds-hotel.table_names.classifications') => Classification::class,
            config('hotelbeds-hotel.table_names.currencies') => Currency::class,
            config('hotelbeds-hotel.table_names.descriptions') => Description::class,
            config('hotelbeds-hotel.table_names.languages') => Language::class
        ]);
    }
}