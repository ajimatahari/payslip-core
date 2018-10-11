<?php

namespace CleaniqueCoders\Payslip\Contracts;

interface SalaryProvider
{
    public function addEarnings(Contribution $contribution);

    public function addDeductions(Contribution $contribution);

    public function getNetSalary();

    public function getEarnings(): array;

    public function getDeductions(): array;

    public function getTotalEarnings(): int;

    public function getTotalDeductions(): int;

    public function handle(): SalaryProvider;
}
