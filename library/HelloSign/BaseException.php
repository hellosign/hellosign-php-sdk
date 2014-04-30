<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

use Exception;

/**
 * Handle all exceptions of HelloSign API
 */
class BaseException extends Exception
{
    /**
     * Error name
     *
     * @var string
     */
    protected $name;

    /**
     * Redefine the exception
     *
     * Name & message are required.
     *
     * @param  string $name
     * @param  string $message
     * @param  integer $code
     * @param  Exception $previous
     */
    public function __construct($name, $message, $code = 0, Exception $previous = null) {
        $this->name = $name;

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     * @ignore
     */
    public  function getName()
    {
        return $this->name;
    }

    /**
     * Custom string representation of object
     *
     * @return string
     * @ignore
     */
    public function __toString() {
        return get_class($this) . ": [{$this->name}] {$this->message}\n";
    }
}
