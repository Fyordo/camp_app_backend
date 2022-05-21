<?php

namespace App\Exceptions;

class NotFoundException extends \Exception
{
    protected $message = "Item not found";
}
