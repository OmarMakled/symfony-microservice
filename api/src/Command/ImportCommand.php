<?php

declare(strict_types=1);

namespace App\Command;

use App\DTO\FruitDTO;
use App\Entity\Fruit;
use App\Service\HttpClient;
use App\Message\ConfirmationEmail;
use App\Repository\FruitRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:import')]
class ImportCommand extends Command
{
    /**
     * @param HttpClient $httpClient
     * @param FruitRepository $fruitRepository
     * @param MessageBusInterface $bus
     */
    public function __construct(
        private readonly HttpClient $httpClient,
        private readonly FruitRepository $fruitRepository,
        private readonly MessageBusInterface $bus
    ) {
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Outputs "Hello World"');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $count = 0;
        foreach ($this->httpClient->getAll() as $fruit) {
            $this->save($fruit);
            $this->bus->dispatch(new ConfirmationEmail($fruit));
            ++$count;
        }
        $output->writeln('👀 Inserted rows [' . $count . ']');
        return Command::SUCCESS;
    }

    /**
     * @param FruitDTO $fruit
     * @return void
     */
    private function save(FruitDTO $fruit): void
    {
        $entity = new Fruit();
        $entity->setGenus($fruit->genus);
        $entity->setName($fruit->name);
        $entity->setFamily($fruit->family);
        $entity->setArrange($fruit->order);
        $entity->setNutritions($fruit->nutritions);

        $this->fruitRepository->save($entity, true);
    }
}
