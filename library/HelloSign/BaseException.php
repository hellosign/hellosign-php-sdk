<?php
/**
 * HelloSign PHP SDK (https://github.com/hellosign/hellosign-php-sdk/)
 */

/**
 * The MIT License (MIT)
 *
 * Copyright (C) 2014 hellosign.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
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
    public function getName()
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
