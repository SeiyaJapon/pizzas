<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Kitchen\Exceptions;

use Exception;

class PizzaNotFoundException extends Exception
{
    public function __construct(string $message = "Pizza not found", int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}