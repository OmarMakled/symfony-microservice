<?php

declare(strict_types=1);

namespace App\Message;

use App\DTO\FruitDTO;

class ConfirmationEmail
{
    /**
     * @param FruitDTO $fruit
     */
    public function __construct(private readonly FruitDTO $fruit)
    {
    }
}
