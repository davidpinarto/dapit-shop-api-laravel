<?php

namespace Tests\Unit\Exceptions;

use App\Exceptions\ClientError;
use App\Exceptions\InvariantError;
use PHPUnit\Framework\TestCase;

class InvariantErrorTest extends TestCase
{
    public function test_should_create_InvariantError_instance_correctly()
    {
        $message = 'invariant error testing';
        $invariantError = new InvariantError($message);

        self::assertEquals($message, $invariantError->getMessage());
        self::assertEquals('InvariantError', $invariantError->getErrorName());
        self::assertEquals(400, $invariantError->getStatusCode());
        self::assertInstanceOf(ClientError::class, $invariantError);
    }
}
