<?php

declare(strict_types=1);

namespace App\Message;

class ConfirmationEmailHandler
{
    /**
     * @param ConfirmationEmail $email
     * @return void
     */
    public function __invoke(ConfirmationEmail $email): void
    {
        // @see rabbitmq
    }
}
