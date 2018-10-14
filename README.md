[![Build Status](https://travis-ci.org/cleaniquecoders/payslip-core.svg?branch=master)](https://travis-ci.org/cleaniquecoders/payslip-core) [![Latest Stable Version](https://poser.pugx.org/cleaniquecoders/payslip-core/v/stable)](https://packagist.org/packages/cleaniquecoders/payslip-core) [![Total Downloads](https://poser.pugx.org/cleaniquecoders/payslip-core/downloads)](https://packagist.org/packages/cleaniquecoders/payslip-core) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cleaniquecoders/payslip-core/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cleaniquecoders/payslip-core/?branch=master) [![License](https://poser.pugx.org/cleaniquecoders/payslip-core/license)](https://packagist.org/packages/cleaniquecoders/payslip-core)

# Payslip Core

This package about provide a simple processor for payslip - calculate employee salary for the given year and month. Each employee have their own earnings and deductions.

Earnings - anything that related to employee for getting more amount of money like Travel Allowance, Meal Allowance, Director Allowance.

Deductions - anything that related to employee for getting less amount of money - Zakat, Laptop Loan, Insurance.

## Earning / Deduction Contribution

To add new earning / deduction, you can implement `CleaniqueCoders\Payslip\Contracts\Contribution` interface. Once implement, you need to add following methods in your class:

```php
public function name(): string
{
	return 'Director Allowance'
}

public function type(): string;
{
	return \CleaniqueCoders\Payslip\Payslip::EARNING; // for earning
	// return \CleaniqueCoders\Payslip\Payslip::DEDUCTION; // for deduction
}

public function contribution()
{
	return 1000; // do your logic to get the amount of contribution
}
```

## Usage

```php
// implement CleaniqueCoders\Payslip\Contracts\Employee interface
$employee = new \App\Models\Employee();
$salary   = new \CleaniqueCoders\Payslip\Salary();

// Earnings
// Implement CleaniqueCoders\Payslip\Contracts\Contribution interface
$basic_salary = new \App\Processors\Payslip\Earnings\BasicSalary();
$basic_salary->setAmount(5000);
$salary->addEarnings($basic_salary);

// Implement CleaniqueCoders\Payslip\Contracts\Contribution interface
$travel_allowance = new \App\Processors\Payslip\Earnings\TravelAllowance();
$travel_allowance->setAmount(500);
$salary->addEarnings($travel_allowance);

// @todo Deductions

// Payslip accept CleaniqueCoders\Payslip\Contracts\Employee contracts and
// CleaniqueCoders\Payslip\Salary object in the constructor
$payslip = new \CleaniqueCoders\Payslip\Payslip($employee, $salary);
$payslip
    ->setYear(2018)
    ->setMonth(10)
    ->setPayday('2018-10-28')
    ->handle();

$summary = $payslip->getSummary();
```
