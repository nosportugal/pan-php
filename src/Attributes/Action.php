<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Action
{
    protected $action = 'allow';

    public function actionIsValid(): bool
    {
        return is_string($this->action);
    }

    public function actionIsRequired(): bool
    {
        return true;
    }
}
