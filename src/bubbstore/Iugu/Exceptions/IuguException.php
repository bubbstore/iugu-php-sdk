<?php

namespace bubbstore\Iugu\Exceptions;

use Exception;

class IuguException extends Exception
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
