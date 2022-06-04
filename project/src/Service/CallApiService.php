<?php

namespace App\Service;
#api_key=790f28ea043da4374d74c13f3cd6b805
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getData($methode, $name): array
    {

        $response = $this->client->request(
            'GET',
            'http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=790f28ea043da4374d74c13f3cd6b805&artist=Karma&track=panthère&format=json'
        );

        return $response->toArray();
    }
}