<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
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
     * Constructor
     *
     * @param  stdClass $response
     * @param  array $options
     * @see    static::fromResponse()
     */
    public function __construct($response = null, $options = array())
    {
        isset($response) && $this->fromResponse($response, $options);
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
}