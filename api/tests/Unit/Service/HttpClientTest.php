<?php

namespace Tests\Unit\Service;

use App\DTO\FruitDTO;
use GuzzleHttp\Client;
use App\Service\HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    private $httpClient;

    protected function setUp(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                [
                    "genus" => "Malus",
                    "name" => "Apple",
                    "id" => 6,
                    "family" => "Rosaceae",
                    "order" => "Rosales",
                    "nutritions" => [
                        "carbohydrates" => 11.4,
                        "protein" => 0.3,
                        "fat" => 0.4,
                        "calories" => 52,
                        "sugar" => 10.3
                    ]
                ],
                [
                    "genus" => "Prunus",
                    "name" => "Apricot",
                    "id" => 35,
                    "family" => "Rosaceae",
                    "order" => "Rosales",
                    "nutritions" => [
                        "carbohydrates" => 3.9,
                        "protein" => 0.5,
                        "fat" => 0.1,
                        "calories" => 15,
                        "sugar" => 3.2
                    ]
                ]
            ])),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);
        $handlerStack = HandlerStack::create($mock);
        $this->httpClient = new HttpClient(new Client(['handler' => $handlerStack]));
    }

    public function testGetAll(): void
    {
        $fruitsDTO = $this->httpClient->getAll();
        $this->assertEquals(2, count($fruitsDTO));
        $this->assertInstanceOf(FruitDTO::class, $fruitsDTO[0]);
        $this->assertInstanceOf(FruitDTO::class, $fruitsDTO[1]);
    }

    public function testGetClient(): void
    {
        $this->assertInstanceOf(Client::class, $this->httpClient->client);
    }
}
