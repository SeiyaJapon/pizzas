<?php

declare (strict_types = 1);

namespace App\SharedContext\Infrastructure\CommandBus;

use App\SharedContext\Application\Command\CommandInterface;

interface CommandBusInterface
{
    public function handle(CommandInterface $command);
}
