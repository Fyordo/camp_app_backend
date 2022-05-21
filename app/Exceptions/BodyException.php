<?php

namespace App\Exceptions;

class BodyException extends \Exception
{
    protected $message = "Incorrect request body";
}
