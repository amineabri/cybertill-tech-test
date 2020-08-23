<?php

namespace Infrastructure\Exceptions;

use Exception;
use Throwable;

/**
 * Class ModelNotFoundException
 * @package Infrastructure\Exceptions
 */
class ModelNotFoundException extends Exception
{
    /**
     * ModelNotCreatedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
