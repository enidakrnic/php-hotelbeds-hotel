<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Chain;
use Redzjovi\HotelbedsHotel\Requests\Types\Chains\IndexRequest;

class ChainImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:chain:import';

    protected $description = 'Import hotelbeds hotel chains';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel chain...');

        /** @var Client */
        $client = App::make(Client::class);

        /** @var Array<string, Chain> */
        $chains = [];

        $request = new IndexRequest();
        $request->from = 1;
        $request->to = 1;
        $response = $client->getChains($request);
        $responseTotal = $response->total;

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $chains = [];

            $request = new IndexRequest();
            $request->language = $languageCode;
            $request->useSecondaryLanguage = true;

            while (count($chains) < $responseTotal) {
                $response = $client->getChains($request);

                foreach ($response->chains as $chain) {
                    /** @var Chain */
                    $model = Chain::query()->firstOrNew([
                        'code' => $chain->code
                    ]);

                    if ($model->save()) {
                        $chains[$model->code] = $model;
                    }

                    if ($chainDescription = $chain->description) {
                        $model->descriptions()->updateOrCreate(
                            ['language_code' => $chainDescription->languageCode],
                            ['content' => $chainDescription->content]
                        );
                    }
                }

                $request->from = $response->getNextFrom();
                $request->to = $response->getNextTo();
            }
        }

        $this->info('Imported hotelbeds hotel chain ('.count($chains).')');
    }
}