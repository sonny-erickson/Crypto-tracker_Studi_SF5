<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    public function testAllPages()
    {
        $client = static::createClient();
        $urls = ['/', 'graph', '/add/crypto', '/add/transaction'];
        foreach ($urls as $url) {
            $client->request('GET', $url);
            $this->assertSame(200, $client->getResponse()->getStatusCode());
            echo $client->getResponse()->getContent();
        }
    }
}
