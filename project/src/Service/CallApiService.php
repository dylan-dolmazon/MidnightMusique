<?php

namespace App\Service;
#api_key=790f28ea043da4374d74c13f3cd6b805
use PhpParser\Node\Expr\Array_;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getData($methode, $data): array
    {

        if($methode === 'musique'){
            $response = $this->client->request(
                'GET',
                'http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=790f28ea043da4374d74c13f3cd6b805&artist='.$data['Artiste'].'&track='.$data['Choice'].'&format=json'
            );
        }else if($methode === 'album'){
            $response = $this->client->request(
                'GET',
                'http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=790f28ea043da4374d74c13f3cd6b805&artist='.$data['Artiste'].'&album='.$data['Choice'].'&format=json'
            );
        }else{
            $response = $this->client->request(
                'GET',
                'http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&api_key=790f28ea043da4374d74c13f3cd6b805&artist='.$data['Artiste'].'&format=json'
            );
            #/2.0/?method=artist.gettoptracks&artist=cher&api_key=YOUR_API_KEY&format=json
        }



        return $response->toArray();
    }
}