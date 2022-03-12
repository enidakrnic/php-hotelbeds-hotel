<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:import';

    protected $description = 'Import hotelbeds hotel';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel...');

        Artisan::call('hotelbeds-hotel:language:import');

        Artisan::call('hotelbeds-hotel:accommodation:import');

        Artisan::call('hotelbeds-hotel:board:import');

        Artisan::call('hotelbeds-hotel:category:import');

        Artisan::call('hotelbeds-hotel:chain:import');

        $this->info('Imported hotelbeds hotel');
    }
}