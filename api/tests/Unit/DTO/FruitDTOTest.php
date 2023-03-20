<?php

namespace App\Tests\Unit\DTO;

use App\DTO\FruitDTO;
use PHPUnit\Framework\TestCase;

class FruitDTOTest extends TestCase
{
    public function testCreateFromArray(): void
    {
        $data = [
            "name" => "Apple",
            "family" => "Rosaceae",
            "order" => "Rosales",
            "genus" => "Malus",
            "nutritions" => [
                "fat" => 0.4,
                "sugar" => 10.3,
                "protein" => 0.3,
                "calories" => 52,
                "carbohydrates" => 11.4
            ]
        ];

        $fruitDTO = FruitDTO::createFromArray($data);

        $this->assertEquals('Apple', $fruitDTO->name);
        $this->assertEquals('Rosaceae', $fruitDTO->family);
        $this->assertEquals('Rosales', $fruitDTO->order);
        $this->assertEquals('Malus', $fruitDTO->genus);
        $this->assertIsArray($fruitDTO->nutritions);
    }
}
