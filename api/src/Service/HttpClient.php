<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\FruitDTO;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientInterface;

class HttpClient
{
    /**
     * @param ClientInterface $client
     */
    public function __construct(public readonly ClientInterface $client)
    {
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getAll(): array
    {
        $response = $this->client->request('GET');

        return $this->serialize(json_decode((string) $response->getBody(), true));
    }

    /**
     * @param array $data
     * @return array
     */
    private function serialize(array $data): array
    {
        $fruitsDTO = [];
        foreach ($data as $row) {
            $fruitsDTO[] = FruitDTO::createFromArray($row);
        }

        return $fruitsDTO;
    }
}
