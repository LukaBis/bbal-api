<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Season;

class FetchAndStoreSeasons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:seasons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches seasons from api and stores them in database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => config('app.bball_api.key'),
            'X-RapidAPI-Host' => config('app.bball_api.host')
        ])->get('https://'.config('app.bball_api.host').'/seasons');

        foreach ($response['response'] as $season) {
            Season::create([
                'season' => $season
            ]);
        }

        $this->info('Seasons stored successfully');

        return Command::SUCCESS;
    }
}
