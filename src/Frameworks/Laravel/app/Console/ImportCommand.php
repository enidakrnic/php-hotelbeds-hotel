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

        $this->info('Imported hotelbeds hotel');
    }
}