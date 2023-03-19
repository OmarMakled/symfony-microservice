<?php
namespace App\Service;

use Psr\Http\Client\ClientInterface;

class HttpClient {
    public function __construct(private readonly ClientInterface $client)
    {
        
    }
    public function getAll(): array
    {
        $response = $this->client->request('GET');

        return json_decode((string) $response->getBody(), true);
    }

    public function getClient() :ClientInterface
    {
        return $this->client;
    }
}