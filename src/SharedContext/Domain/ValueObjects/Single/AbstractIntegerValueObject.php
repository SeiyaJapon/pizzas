<?php
declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObjects\Single;

abstract class AbstractIntegerValueObject
{
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
