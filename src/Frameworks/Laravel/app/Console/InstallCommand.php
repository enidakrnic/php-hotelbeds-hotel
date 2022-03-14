<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:install';

    protected $description = 'Install hotelbeds hotel';

    public function handle()
    {
        $this->info('Installing hotelbeds hotel...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Providers\HotelbedsHotelServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Installed hotelbeds hotel');
    }
}