<?php

namespace App\Report\OrderSummary\Exception;

use Throwable;

class OutputTypeNotSupportedException extends \RuntimeException
{
    public function __construct($message = "report output type not supported", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}