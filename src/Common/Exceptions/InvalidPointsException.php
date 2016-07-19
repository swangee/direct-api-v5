<?php
namespace vedebel\directv5\Common\Exceptions;

use Exception;

class InvalidPointsException extends DirectException
{
    /**
     * InvalidPointsException constructor.
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct($message = 'Invalid points value', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}