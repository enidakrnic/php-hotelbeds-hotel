<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Classification;
use Redzjovi\HotelbedsHotel\Requests\Types\Classifications\IndexRequest;

class ClassificationImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:classification:import';

    protected $description = 'Import hotelbeds hotel classifications';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel classification...');

        /** @var Client */
        $client = App::make(Client::class);

        /** @var Array<string, Classification> */
        $classifications = [];

        $request = new IndexRequest();
        $request->from = 1;
        $request->to = 1;
        $response = $client->getClassifications($request);
        $responseTotal = $response->total;

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $classifications = [];

            $request = new IndexRequest();
            $request->language = $languageCode;
            $request->useSecondaryLanguage = true;

            while (count($classifications) < $responseTotal) {
                $response = $client->getClassifications($request);

                foreach ($response->classifications as $classification) {
                    /** @var Classification */
                    $model = Classification::query()->firstOrNew([
                        'code' => $classification->code
                    ]);

                    if ($model->save()) {
                        $classifications[$model->code] = $model;
                    }

                    if ($classificationDescription = $classification->description) {
                        $model->descriptions()->updateOrCreate(
                            ['language_code' => $classificationDescription->languageCode],
                            ['content' => $classificationDescription->content]
                        );
                    }
                }

                $request->from = $response->getNextFrom();
                $request->to = $response->getNextTo();
            }
        }

        $this->info('Imported hotelbeds hotel classification ('.count($classifications).')');
    }
}