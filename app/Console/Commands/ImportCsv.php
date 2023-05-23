<?php

namespace App\Console\Commands;

use Meilisearch\Client;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('ImportCsv command started');
        $path = public_path('contacts.csv');
        $file = fopen($path, 'r');
        $header = fgetcsv($file); // Lire la première ligne (les en-têtes)

        $client = new Client('host.docker.internal:7700/'); // Remplacez l'URL par l'URL de votre instance MeiliSearch
        $index = $client->index('contact');

        while (($data = fgetcsv($file)) !== false) {
            $record = array_combine($header, $data);

            // add an id to the record
            $record['id'] = Str::uuid();

            $index->addDocuments([$record]);
        }

        fclose($file);

        Log::info('ImportCsv command ended');

    }
}
