<?php

namespace App\Exceptions;

use Exception;

abstract class ClientError extends Exception
{
    protected $statusCode;
    protected $name;

    public function __construct($message = 'Client error', $statusCode = 400, Exception $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);

        $this->statusCode = $statusCode;
        $this->name = 'ClientError';
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorName(): string
    {
        return $this->name;
    }
}
