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

/**
 * Handle all warnings of HelloSign API
 */
class Warning
{
    /**
     * Warning message
     *
     * @var string
     */
    protected $message = null;

    /**
     * Warning name
     *
     * @var string
     */
    protected $name = null;

    /**
     * Constructor
     *
     * @param stdClass $warning_data
     */
    public function __construct($warning_data = null)
    {
        if (isset($warning_data)) {
            $this->setMessage($warning_data->warning_msg);
            $this->setName($warning_data->warning_name);
        }
    }

    /**
     * set warning message
     *
     * @param  String $message
     * @return static
     */
    public function setMessage($message)
    {
        isset($message) && $this->message = $message;
    }

    /**
     * set warning name
     *
     * @param  String $name
     * @return static
     */
    public function setName($name)
    {
        isset($name) && $this->name = $name;
    }

    /**
     * get warning message
     *
     * @return String
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * get warning name
     *
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }
}
