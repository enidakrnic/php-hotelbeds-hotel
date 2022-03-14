<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Facility;
use Redzjovi\HotelbedsHotel\Requests\Types\Facilities\IndexRequest;

class FacilityImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:facility:import';

    protected $description = 'Import hotelbeds hotel facilities';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel facility...');

        /** @var Client */
        $client = App::make(Client::class);

        /** @var Array<int, Facility> */
        $facilities = [];

        $request = new IndexRequest();
        $request->from = 1;
        $request->to = 1;
        $response = $client->getFacilities($request);
        $responseTotal = $response->total;

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $facilities = [];

            $request = new IndexRequest();
            $request->language = $languageCode;
            $request->useSecondaryLanguage = true;

            while (count($facilities) < $responseTotal) {
                $response = $client->getFacilities($request);

                foreach ($response->facilities as $facility) {
                    /** @var Facility */
                    $model = Facility::query()->firstOrNew([
                        'code' => $facility->code,
                        'facility_group_code' => $facility->facilityGroupCode
                    ]);
                    $model->facility_group_code = $facility->facilityGroupCode;
                    $model->facility_typology_code = $facility->facilityTypologyCode;

                    if ($model->save()) {
                        $facilities[$model->id] = $model;
                    }

                    if ($facilityDescription = $facility->description) {
                        $model->descriptions()->updateOrCreate(
                            ['language_code' => $facilityDescription->languageCode],
                            ['content' => $facilityDescription->content]
                        );
                    }
                }

                $request->from = $response->getNextFrom();
                $request->to = $response->getNextTo();
            }
        }

        $this->info('Imported hotelbeds hotel facility ('.count($facilities).')');
    }
}