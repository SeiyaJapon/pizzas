<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObjects\Single;

class PhoneNumber
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $number;

    private function __construct(string $prefix, string $number)
    {
        $this->prefix = $prefix;
        $this->number = $number;
    }

    public static function create(string $prefix, string $number): PhoneNumber
    {
        $prefix = str_replace([' ', '+'], '', $prefix);
        $number = str_replace(' ', '', $number);
        return new self($prefix, $number);
    }

    public function prefix(): string
    {
        return $this->prefix;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function equal(PhoneNumber $phoneNumber): bool
    {
        return $this->prefix === $phoneNumber->prefix &&
            $this->number === $phoneNumber->number;
    }
}
