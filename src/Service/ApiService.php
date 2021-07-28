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

    public function getCryptoPriceMoment(string $cryptoNames)
    {
//       Retourne une liste de crypto et la liste de leur valeurs
        return $this->getApi('simple/price?ids='.$cryptoNames.'&vs_currencies=eur');
    }

    private function getApi(string $requestParam)
    {
        $response = $this->client->request(
            'GET',
            'https://api.coingecko.com/api/v3/' . $requestParam
        );

        return $response->toArray(); // {"ethereum":{"eur":1615.48}} -> ["ethereum"=>["eur"=>1615.48]]
    }


}