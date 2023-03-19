<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetAll(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/fruits');
        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('total', $content);
        $this->assertArrayHasKey('items', $content);
    }

    public function testGetName(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/fruits/name');
        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('items', $content);
    }

    public function testGetFamily(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/fruits/family');
        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('items', $content);
    }
}
