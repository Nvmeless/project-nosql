<?php

namespace App\Http\Controllers;

use Meilisearch\Client;

class IndexController extends Controller
{
    public function getBySchool()
    {
        $client = new Client('host.docker.internal:7700/');
        $index = $client->index('contact');

        $response = $index->search('');

        $rawResults = $response->getRaw();

        $hits = $rawResults['hits'];

        // Compter le nombre d'occurrences de chaque numéro de téléphone
        $phoneNumbersCount = [];
        foreach ($hits as $hit) {
            $phoneNumber = $hit['tel'];
            if (isset($phoneNumbersCount[$phoneNumber])) {
                $phoneNumbersCount[$phoneNumber]++;
            } else {
                $phoneNumbersCount[$phoneNumber] = 1;
            }
        }

        // Trouver le numéro de téléphone avec le plus d'occurrences
        $mostFrequentPhoneNumber = null;
        $maxCount = 0;
        foreach ($phoneNumbersCount as $phoneNumber => $count) {
            if ($count > $maxCount) {
                $mostFrequentPhoneNumber = $phoneNumber;
                $maxCount = $count;
            }
        }

        return view('index', compact('mostFrequentPhoneNumber'));
    }
}
