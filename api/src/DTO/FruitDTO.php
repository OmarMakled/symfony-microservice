<?php

declare(strict_types=1);

namespace App\DTO;

final class FruitDTO
{
    /**
     * @param string $name
     * @param string $family
     * @param string $order
     * @param string $genus
     * @param array $nutritions
     */
    public function __construct(
        public readonly string $name,
        public readonly string $family,
        public readonly string $order,
        public readonly string $genus,
        public readonly array $nutritions
    ) {
    }

    /**
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data): self
    {
        return new FruitDTO(
            name: $data['name'],
            family: $data['family'],
            order: $data['order'],
            genus: $data['genus'],
            nutritions: $data['nutritions']
        );
    }
}
