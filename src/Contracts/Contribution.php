<?php

namespace CleaniqueCoders\Payslip\Contracts;

interface Contribution
{
    public function name(): string;

    public function type(): string;

    public function contribution();
}
