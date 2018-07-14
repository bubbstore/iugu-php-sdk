<?php

namespace bubbstore\Iugu\Exceptions;

use Exception;

class IuguValidationException extends Exception
{
    private $errors;

    public function __construct($message, $code, $errors = [])
    {
        $this->errors = $errors;
        parent::__construct($message, $code);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
