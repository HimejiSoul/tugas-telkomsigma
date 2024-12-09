<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Person;
use Illuminate\Support\Facades\Http;

class ConsumeApiData extends Command
{
    protected $signature = 'consume:api-data';
    protected $description = 'Consume API data and save to database';

    public function handle()
    {
        $response = Http::withOptions(['verify' => false])
            ->get('https://randomuser.me/api/?results=5');

        if ($response->successful()) {
            $data = $response->json()['results'];

            foreach ($data as $item) {
                Person::updateOrCreate(
                    [
                        'firstname' => $item['name']['first'],
                        'lastname' => $item['name']['last'],
                        'category' => $item['gender'],
                        'date' => now(),
                    ]
                );
            }

            $this->info('Data successfully imported!');
        } else {
            $this->error('Failed to fetch API data.');
        }
    }
}
