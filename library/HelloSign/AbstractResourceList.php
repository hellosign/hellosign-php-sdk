<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
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
        isset($response) && $this->fromResponse($response);
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
}