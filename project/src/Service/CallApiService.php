<?php

namespace App\Service;

use SpotifyWebAPI\Session;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use SpotifyWebAPI\SpotifyWebAPI;

class CallApiService
{

    private $client;
    private $session;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;

        $this->session = new Session(
            'CLIENT_ID',
            'CLIENT_SECRET',
            'REDIRECT_URI'
        );


        $api = new SpotifyWebAPI\SpotifyWebAPI();

        if (isset($_GET['code'])) {
            $this->session->requestAccessToken($_GET['code']);
            $api->setAccessToken($this->session->getAccessToken());

            print_r($api->me());
        } else {
            $options = [
                'scope' => [
                    'user-read-email',
                ],
            ];
        }
    }

    public function getData(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.spotify.com/v1/artists/1vCWHaC5f2uS3yhpwWbIA6/albums?album_type=SINGLE&offset=20&limit=10'
        );

        return $response->toArray();
    }
}