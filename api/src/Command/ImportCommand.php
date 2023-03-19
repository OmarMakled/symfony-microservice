<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Repository\FruitRepository;
use App\Service\HttpClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:import')]
class ImportCommand extends Command
{ 
  public function __construct(private readonly HttpClient $httpClient, private readonly FruitRepository $fruitRepository)
  {
    parent::__construct();
  }

    protected function configure()
    {
        $this->setDescription('Outputs "Hello World"');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $count = 0;
        foreach($this->httpClient->getAll() as $row){
          $fruit = new Fruit;
          $fruit->setGenus($row['genus']);
          $fruit->setName($row['name']);
          $fruit->setFamily($row['family']);
          $fruit->setArrange($row['order']);
          $fruit->setNutritions($row['nutritions']);
    
          $this->fruitRepository->save($fruit, true);
            ++$count;
        }
        $output->writeln('Hello World ' . $count);
        return Command::SUCCESS;
    }
}