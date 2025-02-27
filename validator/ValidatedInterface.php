<?php
declare(strict_types=1);

namespace app\validator;

interface ValidatedInterface
{
    public function validate($attributeNames = null, $clearErrors = true);

    public function getErrors();

    public function addError(string $attribute, string $message);
}
