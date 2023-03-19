<?php

namespace Tests\Unit\Service;

use GuzzleHttp\Client;
use App\Service\HttpClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @group units
 * @author Omar Makled <omar.makled@gmail.com>
 */
class HttpClientTest extends KernelTestCase
{
  private $httpClient;

  protected function setUp(): void
  {
      self::bootKernel();
      $this->httpClient = self::getContainer()->get(HttpClient::class);
  }

  public function testGetClient(): void
  {
    $this->assertInstanceOf(Client::class, $this->httpClient->getClient());
  }
}