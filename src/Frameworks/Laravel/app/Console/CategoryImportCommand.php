<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Category;
use Redzjovi\HotelbedsHotel\Requests\Types\Categories\IndexRequest;

class CategoryImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:category:import';

    protected $description = 'Import hotelbeds hotel categories';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel category...');

        /** @var Client */
        $client = App::make(Client::class);

        /** @var Array<string, Category> */
        $categories = [];

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $request = new IndexRequest();
            $request->language = $languageCode;
            $request->useSecondaryLanguage = true;
            $response = $client->getCategories($request);

            foreach ($response->categories as $category) {
                /** @var Category */
                $model = Category::query()->firstOrNew([
                    'code' => $category->code,
                ]);
                $model->accommodation_type = $category->accommodationType;
                $model->group = $category->group;
                $model->simple_code = $category->simpleCode;

                if ($model->save()) {
                    $categories[$model->code] = $model;
                }

                if ($categoryDescription = $category->description) {
                    $model->descriptions()->updateOrCreate(
                        ['language_code' => $categoryDescription->languageCode],
                        ['content' => $categoryDescription->content]
                    );
                }
            }
        }

        $this->info('Imported hotelbeds hotel category ('.count($categories).')');
    }
}