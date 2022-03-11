<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Board;
use Redzjovi\HotelbedsHotel\Requests\Types\Boards\IndexRequest;

class BoardImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:board:import';

    protected $description = 'Import hotelbeds hotel boards';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel board...');

        /** @var Client */
        $client = App::make(Client::class);
        $request = new IndexRequest();
        $request->useSecondaryLanguage = true;

        /** @var Array<string, Board> */
        $boards = [];

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $request->language = $languageCode;
            $response = $client->getBoards($request);

            foreach ($response->boards as $board) {
                /** @var Board */
                $model = Board::query()->firstOrNew([
                    'code' => $board->code,
                ]);
                $model->multi_lingual_code = $board->multiLingualCode;

                if ($model->save()) {
                    $boards[$model->code] = $model;
                }

                if ($boardDescription = $board->description) {
                    $model->descriptions()->updateOrCreate(
                        ['language_code' => $boardDescription->languageCode],
                        ['content' => $boardDescription->content]
                    );
                }
            }
        }

        $this->info('Imported hotelbeds hotel board ('.count($boards).')');
    }
}