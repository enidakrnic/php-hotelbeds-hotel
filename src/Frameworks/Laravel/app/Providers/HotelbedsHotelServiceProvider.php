<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\ImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\LanguageImportCommand;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console\InstallCommand;
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
                InstallCommand::class,
                ImportCommand::class,
                LanguageImportCommand::class
            ]);

            $this->publishes([
                __DIR__.'/../../config/hotelbeds-hotel.php' => config_path('hotelbeds-hotel.php'),
            ], 'config');

            if (! class_exists('CreateHotelbedsHotelDescriptionTable')) {
                $this->publishes([
                  __DIR__ . '/../../database/migrations/create_table_hotelbeds_hotel_description_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_hotelbeds_hotel_description_table.php'),
                ], 'migrations');
            }

            if (! class_exists('CreateHotelbedsHotelLanguageTable')) {
                $this->publishes([
                  __DIR__ . '/../../database/migrations/create_table_hotelbeds_hotel_language_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_hotelbeds_hotel_language_table.php'),
                ], 'migrations');
            }
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
            config('hotelbeds-hotel.table_names.descriptions') => Description::class,
            config('hotelbeds-hotel.table_names.languages') => Language::class
        ]);
    }
}