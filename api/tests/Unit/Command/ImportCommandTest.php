<?php

namespace App\Tests\Unit\Command;

use App\Service\HttpClient;
use App\Command\ImportCommand;
use App\Repository\FruitRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;

class ImportCommandTest extends WebTestCase
{
    private $command;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $httpClient = $this->createMock(HttpClient::class);
        $fruitRepository = $this->createMock(FruitRepository::class);
        $messageBus = $this->createMock(MessageBusInterface::class);
        $application->add(new ImportCommand(
            httpClient: $httpClient,
            fruitRepository: $fruitRepository,
            bus: $messageBus
        ));
        $this->command = new CommandTester($application->find('app:import'));
    }

    public function testExecute(): void
    {
        $this->assertEquals(Command::SUCCESS, $this->command->execute([]));
    }
}
