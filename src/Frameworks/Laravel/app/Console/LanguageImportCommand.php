<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Language;
use Redzjovi\HotelbedsHotel\Requests\Types\Languages\IndexRequest;

class LanguageImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:language:import';

    protected $description = 'Import hotelbeds hotel languages';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel language...');

        /** @var Client */
        $client = App::make(Client::class);
        $request = new IndexRequest();
        $request->useSecondaryLanguage = true;

        /** @var Array<string, Language> */
        $languages = [];

        foreach (config('hotelbeds-hotel.language.codes') as $languageCodes) {
            $request->language = $languageCodes;
            $response = $client->getLanguages($request);

            foreach ($response->languages as $language) {
                /** @var Language */
                $model = Language::query()->firstOrNew([
                    'code' => $language->code,
                ]);
                $model->name = $language->name;

                if ($model->save()) {
                    $languages[$model->code] = $model;
                }

                if ($languageDescription = $language->description) {
                    $model->descriptions()->updateOrCreate(
                        ['language_code' => $languageDescription->languageCode],
                        ['content' => $languageDescription->content]
                    );
                }
            }
        }

        $this->info('Imported hotelbeds hotel language ('.count($languages).')');
    }
}