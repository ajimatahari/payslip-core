<?php

namespace CleaniqueCoders\Payslip\Tests;

use CleaniqueCoders\Payslip\Payslip;
use CleaniqueCoders\Payslip\Salary;
use CleaniqueCoders\Payslip\Tests\Stubs\BasicSalary;
use CleaniqueCoders\Payslip\Tests\Stubs\Employee;
use CleaniqueCoders\Payslip\Tests\Stubs\TravelAllowance;

class PayslipTest extends TestCase
{
    /** @test */
    public function t()
    {
        $employee = new Employee();
        $salary   = new Salary();

        // Earnings
        $basic_salary = new BasicSalary();
        $basic_salary->setAmount(5000);
        $salary->addEarnings($basic_salary);

        $travel_allowance = new TravelAllowance();
        $travel_allowance->setAmount(500);
        $salary->addEarnings($travel_allowance);

        // @todo Deductions

        $payslip = new Payslip($employee, $salary);
        $payslip
            ->setYear(2018)
            ->setMonth(10)
            ->setPayday('2018-10-28')
            ->handle();

        $summary = $payslip->getSummary();

        $this->assertTrue(isset($summary['total_earnings']));
        $this->assertTrue(isset($summary['total_deductions']));
        $this->assertEquals(5500, $summary['total_earnings']);
        $this->assertEquals(0, $summary['total_deductions']);
        $this->assertEquals(5500, $summary['net_salary']);
        $this->assertEquals('2018-10-28', $summary['payday']);
    }
}
