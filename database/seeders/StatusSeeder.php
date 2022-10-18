<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusesFile = file_get_contents(__DIR__ . '/assets/statuses.json');
        $statuses     = json_decode($statusesFile, true);

        foreach ($statuses as $short => $long) {
            Status::create([
                'short' => $short,
                'long'  => $long,
            ]);
        }
    }
}
