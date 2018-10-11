<?php

namespace CleaniqueCoders\Payslip\Contracts;

interface PayslipProvider
{
    public function addPayslip(Payslip $payslip);

    public function getPaylips(): array;
}
