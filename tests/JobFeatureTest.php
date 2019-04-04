<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller test
 */
class JobFeatureTest extends WebTestCase
{
	public function testFetchByID()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/job/1');
        $result = $client->getResponse();
        $content = json_decode($result->getContent(), true);
        $this->assertSame(200, $result->getStatusCode());
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals($content['id'], 1);
    }

	public function testFetchByLocation()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/job/location/DE/Salary');
        $result = $client->getResponse();
        $content = json_decode($result->getContent(), true);
        $this->assertSame(200, $result->getStatusCode());
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertEquals($content[0]['company']['country'], "DE");
    }

    public function testMostInterestingPosition()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/job/match/php/middle');
        $result = $client->getResponse();
        $this->assertSame(200, $result->getStatusCode());
        $this->assertInstanceOf(JsonResponse::class, $result);
    }
}
