<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models\Issue;
use Redzjovi\HotelbedsHotel\Requests\Types\Issues\IndexRequest;

class IssueImportCommand extends Command
{
    protected $signature = 'hotelbeds-hotel:issue:import';

    protected $description = 'Import hotelbeds hotel issues';

    public function handle()
    {
        $this->info('Importing hotelbeds hotel issue...');

        /** @var Client */
        $client = App::make(Client::class);

        /** @var Array<string, Issue> */
        $issues = [];

        $request = new IndexRequest();
        $request->from = 1;
        $request->to = 1;
        $response = $client->getIssues($request);
        $responseTotal = $response->total;

        foreach (config('hotelbeds-hotel.language.codes') as $languageCode) {
            $issues = [];

            $request = new IndexRequest();
            $request->language = $languageCode;
            $request->useSecondaryLanguage = true;

            while (count($issues) < $responseTotal) {
                $response = $client->getIssues($request);

                foreach ($response->issues as $issue) {
                    /** @var Issue */
                    $model = Issue::query()->firstOrNew([
                        'code' => $issue->code,
                        'type' => $issue->type
                    ]);
                    $model->type = $issue->type;
                    $model->alternative = $issue->alternative;

                    if ($model->save()) {
                        $issues[$model->code.'-'.$issue->type] = $model;
                    }

                    if ($issueDescription = $issue->description) {
                        $model->descriptions()->updateOrCreate(
                            ['language_code' => $issueDescription->languageCode],
                            ['content' => $issueDescription->content]
                        );
                    }

                    if ($issueName = $issue->name) {
                        $model->names()->updateOrCreate(
                            ['language_code' => $issueName->languageCode],
                            ['content' => $issueName->content]
                        );
                    }
                }

                $request->from = $response->getNextFrom();
                $request->to = $response->getNextTo();
            }
        }

        $this->info('Imported hotelbeds hotel issue ('.count($issues).')');
    }
}