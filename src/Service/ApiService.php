<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiService
{
        //private $apiLink = 'https://api.coingecko.com/api/v3/';
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
        public function getImage(): array
    {
        return $this->getApi('coins/');
    }
    public function getCrypto($name): array
    {
        return $this->getApi('coins/' . $name);
    }
    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'https://api.coingecko.com/api/v3/' . $var
        );

        return $response->toArray();
    }


}