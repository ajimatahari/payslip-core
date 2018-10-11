<?php

namespace CleaniqueCoders\Payslip\Tests\Stubs;

use CleaniqueCoders\Payslip\Contracts\Contribution;
use CleaniqueCoders\Payslip\Payslip;

class TravelAllowance implements Contribution
{
    private $amount;

    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function name(): string
    {
        return 'Travel Allowance';
    }

    public function type(): string
    {
        return Payslip::EARNING;
    }

    public function contribution()
    {
        return $this->getAmount();
    }
}
