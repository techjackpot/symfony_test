<?php

namespace App\Client;

use App\ValueObject\Point;
use GuzzleHttp\Client;

class GoogleGeocoderClient
{
    /**
     * @var string
     */
    private $key;

    /**
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getPointFromAddress($address)
    {
        $response = $this->getClient()->request('GET', '/maps/api/geocode/json', [
            'query' => [
                'address' => $address,
                'key'     => $this->key,
                'sensor'  => false,
            ],
        ]);

        $results = json_decode($response->getBody()->getContents(), true);

        return new Point($results['results'][0]['geometry']['location']['lat'],
            $results['results'][0]['geometry']['location']['lng']);
    }

    public function getClient()
    {
        return new Client([
            'base_uri' => 'https://maps.googleapis.com',
        ]);
    }
}