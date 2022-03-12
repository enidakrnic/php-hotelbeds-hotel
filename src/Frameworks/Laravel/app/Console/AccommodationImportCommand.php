<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Accommodation;
use Redzjovi\HotelbedsHotel\Requests\Types\Accommodations\IndexRequest;

class AccommodationImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:accommodation:import';

    protected $description = 'Import hotelbeds hotel accommodations';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel accommodation...');

        /** @var Client */
        $client = App::make(Client::class);

        /** @var Array<string, Accommodation> */
        $accommodations = [];

        $request = new IndexRequest();
        $request->from = 1;
        $request->to = 1;
        $response = $client->getAccommodations($request);
        $responseTotal = $response->total;

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $accommodations = [];

            $request = new IndexRequest();
            $request->language = $languageCode;
            $request->useSecondaryLanguage = true;

            while (count($accommodations) < $responseTotal) {
                $response = $client->getAccommodations($request);

                foreach ($response->accommodations as $accommodation) {
                    /** @var Accommodation */
                    $model = Accommodation::query()->firstOrNew([
                        'code' => $accommodation->code
                    ]);
                    $model->type_description = $accommodation->typeDescription;

                    if ($model->save()) {
                        $accommodations[$model->code] = $model;
                    }

                    if ($accommodationTypeMultiDescription = $accommodation->typeMultiDescription) {
                        $model->typeMultiDescriptions()->updateOrCreate(
                            ['language_code' => $accommodationTypeMultiDescription->languageCode],
                            ['content' => $accommodationTypeMultiDescription->content]
                        );
                    }

                    $request->from = $response->getNextFrom();
                    $request->to = $response->getNextTo();
                }
            }
        }

        $this->info('Imported hotelbeds hotel accommodation ('.count($accommodations).')');
    }
}