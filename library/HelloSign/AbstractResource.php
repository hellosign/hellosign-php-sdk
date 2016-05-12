<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
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
 * A nice place to put code that is common to all HelloSign resource classes
 */
abstract class AbstractResource extends AbstractObject
{
    /**
     * Type of resource
     *
     * @var string
     */
    protected $resource_type = null;

    /**
     * Warnings received from API
     *
     * @var array
     */
    protected $warnings = array();

    /**
     * Whether this is a test signature request
     *
     * Test requests have no legal value. Defaults to false.
     *
     * @var boolean
     */
    protected $test_mode = false;

    /**
     * The title the specified Account uses for the SignatureRequest
     *
     * @var string
     */
    protected $title = null;

    /**
     * The subject in the email that was initially sent to the signers
     *
     * @var string
     */
    protected $subject = null;

    /**
     * The custom message in the email that was initially sent to the signers
     *
     * @var string
     */
    protected $message = null;

    /**
     * The file(s) to send for signature
     *
     * @var array
     */
    protected $file = array();

    /**
     * The URLs at which this request's files can be retrieved.
     *
     * @var array
     */
    protected $file_url = array();

    /**
     * Constructor
     *
     * @param  stdClass $response
     * @param  array $options
     * @see    static::fromResponse()
     */
    public function __construct($response = null, $options = array())
    {
        if (isset($response)) {
            $this->fromResponse($response, $options);
            $this->warningsFromResponse($response);
        }
    }

    /**
     * @return SignatureRequest
     * @ignore
     */
    public function enableTestMode()
    {
        $this->test_mode = true;
        return $this;
    }

    /**
     * @return SignatureRequest
     * @ignore
     */
    public function disableTestMode()
    {
        $this->test_mode = false;
        return $this;
    }

    /**
     * @param  string $title
     * @return SignatureRequest
     * @ignore
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param  string $subject
     * @return SignatureRequest
     * @ignore
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param  string $message
     * @return SignatureRequest
     * @ignore
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Utility function that checks to see if we should be using CURLFile instead
     * of @ for file params.
     *
     * @return boolean
     * @ignore
     */
    public function shouldUseCURLFile()
    {
        if (version_compare(PHP_VERSION, '5.5.0', '>=')) {
            return true;
        }

        return false;
    }

    /**
     * @param  string $file path for file
     * @return AbstractResource
     * @ignore
     */
    public function addFile($file)
    {
        if (!file_exists($file)) {
            throw new Error('file not found', 'File does not exist. Please use an absolute file path.');
        }

        // Disabling this new syntax for now due to conflicts with the REST client
        if (static::shouldUseCURLFile()) {
            // PHP 5.5 introduced a CURLfile object that deprecates the old @filename syntax
            // See: https://wiki.php.net/rfc/curl-file-upload
            $f = new \CURLfile($file);
        } else {
            $f = "@$file";
        }

        $this->file[] = $f;
        return $this;
    }

    /**
     * @param string $file_url
     * @return AbstractResource
     */
    public function addFileUrl($file_url) {
        if (empty($file_url)) {
            throw new Error('unknown', 'Empty file URL');
        }
        if (filter_var($file_url, FILTER_VALIDATE_URL) === false) {
            throw new Error('unknown', 'Invalid file URL');
        }
        $this->file_url[] = $file_url;
        return $this;
    }

    /**
     * @return array
     * @ignore
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * Populate from response
     *
     * @param  stdClass $response
     * @param  array $options
     * @return static
     * @see    static::fromObject()
     * @see    static::fromArray()
     */
    public function fromResponse($response, $options = array())
    {
        return $this->fromObject($response->{$this->resource_type}, $options);
    }

    public function warningsFromResponse($response)
    {
        if (property_exists($response, 'warnings') && is_array($response->warnings)) {
            foreach ($response->warnings as $warning) {
                array_push($this->warnings, new Warning($warning));
            }
            $this->warnings = $response->warnings;
        }
    }
}
