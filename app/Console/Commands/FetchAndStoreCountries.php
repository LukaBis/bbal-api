<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Country;

class FetchAndStoreCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches countries from api and stores them in database.';

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
        ])->get('https://'.config('app.bball_api.host').'/countries');

        foreach($response['response'] as $country) {
            Country::create([
                'id' => $country['id'],
                'name' => $country['name'],
                'code' => $country['code'],
                'flag_url' => $country['flag'],
            ]);
        }

        $this->info('Countires stored successfully');

        return Command::SUCCESS;
    }
}
