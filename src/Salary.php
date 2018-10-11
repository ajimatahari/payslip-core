<?php

namespace CleaniqueCoders\Payslip;

use CleaniqueCoders\Payslip\Contracts\Contribution;
use CleaniqueCoders\Payslip\Contracts\SalaryProvider;

class Salary implements SalaryProvider
{
    protected $earnings   = [];
    protected $deductions = [];

    public function addEarnings(Contribution $contribution)
    {
        $this->earnings[] = $contribution;
    }

    public function addDeductions(Contribution $contribution)
    {
        $this->deductions[] = $contribution;
    }

    public function getEarnings(): array
    {
        return $this->earnings;
    }

    public function getDeductions(): array
    {
        return $this->deductions;
    }

    public function getNetSalary(): int
    {
        return $this->net_salary;
    }

    public function getTotalEarnings(): int
    {
        return $this->total_earnings;
    }

    public function getTotalDeductions(): int
    {
        return $this->total_deductions;
    }

    public function handle(): SalaryProvider
    {
        $this->total_earnings = 0;
        foreach ($this->getEarnings() as $earning) {
            $this->total_earnings += $earning->contribution();
        }

        $this->total_deductions = 0;
        foreach ($this->getDeductions() as $deduction) {
            $this->total_deductions += $deduction->contribution();
        }

        $this->net_salary = $this->getTotalEarnings() - $this->getTotalDeductions();

        return $this;
    }
}
