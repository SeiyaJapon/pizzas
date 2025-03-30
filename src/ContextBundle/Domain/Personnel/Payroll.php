<?php

declare(strict_types=1);

namespace App\ContextBundle\Domain\Personnel;

class Payroll
{
    private string $id;
    private string $employeeId;
    private \DateTimeImmutable $periodStart;
    private \DateTimeImmutable $periodEnd;
    private float $baseSalary;
    private array $deductions;
    private array $bonuses;
    private float $netAmount;
    private bool $paid;

    public function __construct(
        string $id,
        string $employeeId,
        \DateTimeImmutable $periodStart,
        \DateTimeImmutable $periodEnd,
        float $baseSalary
    ) {
        $this->id = $id;
        $this->employeeId = $employeeId;
        $this->periodStart = $periodStart;
        $this->periodEnd = $periodEnd;
        $this->baseSalary = $baseSalary;
        $this->deductions = [];
        $this->bonuses = [];
        $this->netAmount = $baseSalary;
        $this->paid = false;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }

    public function getPeriodStart(): \DateTimeImmutable
    {
        return $this->periodStart;
    }

    public function getPeriodEnd(): \DateTimeImmutable
    {
        return $this->periodEnd;
    }

    public function getBaseSalary(): float
    {
        return $this->baseSalary;
    }

    public function addDeduction(float $amount, string $reason): void
    {
        $this->deductions[] = [
            'amount' => $amount,
            'reason' => $reason
        ];
        $this->calculateNetAmount();
    }

    public function addBonus(float $amount, string $reason): void
    {
        $this->bonuses[] = [
            'amount' => $amount,
            'reason' => $reason
        ];
        $this->calculateNetAmount();
    }

    public function getDeductions(): array
    {
        return $this->deductions;
    }

    public function getBonuses(): array
    {
        return $this->bonuses;
    }

    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }

    public function markAsPaid(): void
    {
        $this->paid = true;
    }

    private function calculateNetAmount(): void
    {
        $totalDeductions = array_sum(array_column($this->deductions, 'amount'));
        $totalBonuses = array_sum(array_column($this->bonuses, 'amount'));
        $this->netAmount = $this->baseSalary - $totalDeductions + $totalBonuses;
    }
} 