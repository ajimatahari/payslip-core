<?php

namespace CleaniqueCoders\Payslip;

use CleaniqueCoders\Payslip\Contracts\Employee;
use CleaniqueCoders\Payslip\Contracts\Payslip as PayslipContract;
use CleaniqueCoders\Payslip\Contracts\SalaryProvider as Salary;
use CleaniqueCoders\Payslip\Contracts\Summary as PayslipSummaryContract;

class Payslip implements PayslipContract, PayslipSummaryContract
{
    const EARNING   = 1;
    const DEDUCTION = 2;

    public $employee;
    public $salary;

    public function __construct(Employee $employee, Salary $salary)
    {
        $this->employee = $employee;
        $this->salary   = $salary;
    }

    public function setYear(int $year): PayslipContract
    {
        $this->year = $year;

        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setMonth(int $month): PayslipContract
    {
        $this->month = $month;

        return $this;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function setPayday($payday_date): PayslipContract
    {
        $this->payday = $payday_date;

        return $this;
    }

    public function getPayday()
    {
        return $this->payday;
    }

    public function handle(): PayslipContract
    {
        $this->salary->handle();

        return $this;
    }

    public function getSummary(): array
    {
        return [
            'net_salary'       => $this->salary->getNetSalary(),
            'total_earnings'   => $this->salary->getTotalEarnings(),
            'total_deductions' => $this->salary->getTotalDeductions(),
            'payday'           => $this->getPayday(),
        ];
    }
}
