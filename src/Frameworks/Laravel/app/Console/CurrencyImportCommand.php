<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Currency;
use Redzjovi\HotelbedsHotel\Requests\Types\Currencies\IndexRequest;

class CurrencyImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:currency:import';

    protected $description = 'Import hotelbeds hotel currencies';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel currency...');

        /** @var Client */
        $client = App::make(Client::class);

        /** @var Array<string, Currency> */
        $currencies = [];

        $request = new IndexRequest();
        $request->from = 1;
        $request->to = 1;
        $response = $client->getCurrencies($request);
        $responseTotal = $response->total;

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $currencies = [];

            $request = new IndexRequest();
            $request->language = $languageCode;
            $request->useSecondaryLanguage = true;

            while (count($currencies) < $responseTotal) {
                $response = $client->getCurrencies($request);

                foreach ($response->currencies as $currency) {
                    /** @var Currency */
                    $model = Currency::query()->firstOrNew([
                        'code' => $currency->code
                    ]);
                    $model->currency_type = $currency->currencyType;

                    if ($model->save()) {
                        $currencies[$model->code] = $model;
                    }

                    if ($currencyDescription = $currency->description) {
                        $model->descriptions()->updateOrCreate(
                            ['language_code' => $currencyDescription->languageCode],
                            ['content' => $currencyDescription->content]
                        );
                    }
                }

                $request->from = $response->getNextFrom();
                $request->to = $response->getNextTo();
            }
        }

        $this->info('Imported hotelbeds hotel currency ('.count($currencies).')');
    }
}