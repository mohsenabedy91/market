<?php

namespace Modules\Authentication\Exceptions\V1;

use Exception;
use Throwable;

class UserAlreadyExistException extends Exception
{
    /**
     * @param string|null $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = null, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
