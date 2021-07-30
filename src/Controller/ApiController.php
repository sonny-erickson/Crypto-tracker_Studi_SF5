<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $apiUrl = 'https://api.coingecko.com/api/v3/';

    public function getCrypto($name)
    {
        $resp = file_get_contents( $this->apiUrl . 'coins/'. $name);
        $resp = json_decode($resp);
        return $resp;
    }

    public function getImage($crypto)
    {
        $resp = file_get_contents( $this->apiUrl . 'coins/');
        $resp = json_decode($resp);
        $r = $resp->image->small;
        return $resp;
    }

    public function getCryptoPriceMoment($cryptoName)
        {
            $cryptoName = strtolower($cryptoName);
            //lit tout un fichier dans une chaine
            $resp = file_get_contents( $this->apiUrl . 'simple/price?ids='. $cryptoName .'&vs_currencies=eur');

            $resp = json_decode($resp);
            $r = $resp->$cryptoName->eur;





            return $r;
        }
}