<?php
namespace Procob\Exceptions;

use Exception;

class ProcobException extends Exception
{
    /**
     * @var mixed
     */
    protected $errorCode;

    /**
     * ProcobException constructor.
     * @param string|null $message
     * @param mixed|null $errorCode
     */
    public function __construct(string $message = null, $errorCode = null)
    {
        $message = $message ? trim($message) : 'Undefined error';

        $this->errorCode = $errorCode;

        parent::__construct($message);
    }

    /**
     * @return mixed|null
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
