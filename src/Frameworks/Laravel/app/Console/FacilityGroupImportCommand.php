<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\FacilityGroup;
use Redzjovi\HotelbedsHotel\Requests\Types\FacilityGroups\IndexRequest;

class FacilityGroupImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:facility-group:import';

    protected $description = 'Import hotelbeds hotel facility groups';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel facility group...');

        /** @var Client */
        $client = App::make(Client::class);

        /** @var Array<string, FacilityGroup> */
        $facilityGroups = [];

        $request = new IndexRequest();
        $request->from = 1;
        $request->to = 1;
        $response = $client->getFacilityGroups($request);
        $responseTotal = $response->total;

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $facilityGroups = [];

            $request = new IndexRequest();
            $request->language = $languageCode;
            $request->useSecondaryLanguage = true;

            while (count($facilityGroups) < $responseTotal) {
                $response = $client->getFacilityGroups($request);

                foreach ($response->facilityGroups as $facilityGroup) {
                    /** @var FacilityGroup */
                    $model = FacilityGroup::query()->firstOrNew([
                        'code' => $facilityGroup->code
                    ]);

                    if ($model->save()) {
                        $facilityGroups[$model->code] = $model;
                    }

                    if ($facilityGroupDescription = $facilityGroup->description) {
                        $model->descriptions()->updateOrCreate(
                            ['language_code' => $facilityGroupDescription->languageCode],
                            ['content' => $facilityGroupDescription->content]
                        );
                    }
                }

                $request->from = $response->getNextFrom();
                $request->to = $response->getNextTo();
            }
        }

        $this->info('Imported hotelbeds hotel facility group ('.count($facilityGroups).')');
    }
}