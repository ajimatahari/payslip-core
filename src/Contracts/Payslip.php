<?php

namespace CleaniqueCoders\Payslip\Contracts;

interface Payslip
{
    public function setYear(int $year): Payslip;

    public function getYear(): int;

    public function setMonth(int $month): Payslip;

    public function getMonth(): int;

    public function setPayday($payday_date): Payslip;

    public function getPayday();

    public function handle(): Payslip;
}
