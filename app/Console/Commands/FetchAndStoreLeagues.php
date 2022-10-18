<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\League;
use App\Models\Country;
use App\Models\Season;

class FetchAndStoreLeagues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:leagues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches all leagues from basketball api and stores them in database.';

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
        ])->get('https://'.config('app.bball_api.host').'/leagues');

        foreach ($response['response'] as $league) {
            $leagues = League::create([
                'id'         => $league['id'],
                'name'       => $league['name'],
                'type'       => $league['type'],
                'logo_url'   => $league['logo'],
                'country_id' => Country::find($league['country']['id'])->id
            ]);

            foreach ($league['seasons'] as $season) {
                $leagues->seasons()->attach(
                    Season::where('season', $season['season'])->get('id')->first()->id
                );
            }
        }

        $this->info('Leagues stored successfully');

        return Command::SUCCESS;
    }
}
