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
 * A nice place to put code that is common to all HelloSign resource list classes
 */
abstract class AbstractResourceList extends AbstractList
{
    /**
     * Type of list
     *
     * @var string
     */
    protected $list_type = null;

    /**
     * Warnings received from API
     *
     * @var array
     */
    protected $warnings = array();

    /**
     * Number of the page being returned
     *
     * @var integer
     */
    protected $page = 1;

    /**
     * Total number of pages available
     *
     * @var integer
     */
    protected $num_pages = 0;

    /**
     * Total number of objects available
     *
     * @var integer
     */
    protected $num_results = 0;

    /**
     * Objects returned per page
     *
     * @var integer
     */
    protected $page_size = null;

    /**
     * Constructor
     *
     * @param  stdClass $response
     * @see    static::fromResponse()
     */
    public function __construct($response = null)
    {
        if (isset($response)) {
            $this->fromResponse($response);
            $this->warningsFromResponse($response);
        }
    }

    /**
     * @return integer
     * @ignore
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getNumPages()
    {
        return $this->num_pages;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getNumResults()
    {
        return $this->num_results;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getPageSize()
    {
        return $this->page_size;
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
     * @return static
     * @see    static::setCollection()
     */
    public function fromResponse($response)
    {
        $this->page        = $response->list_info->page;
        $this->num_pages   = $response->list_info->num_pages;
        $this->num_results = $response->list_info->num_results;
        $this->page_size   = $response->list_info->page_size;

        property_exists($response, $this->list_type) && $this->setCollection($response->{$this->list_type});

        return $this;
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
