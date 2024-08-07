<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Rulebase
{
    protected $rulebase;

    public function rulebaseIsValid(): bool
    {
        return ($this->rulebase == 'pre' || $this->rulebase == 'post');
    }

    public function rulebaseIsRequired(): bool
    {
        return true;
    }
}
