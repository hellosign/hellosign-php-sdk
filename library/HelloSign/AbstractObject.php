<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * This class has basic functions to populate object, export object's attributes
 * to array
 */
abstract class AbstractObject
{
    /**
     * Constructor
     *
     * @param  array $array
     * @param  array $options
     * @see    static::fromArray()
     */
    public function __construct($array = array(), $options = array())
    {
        $this->fromArray($array, $options);
    }

    /**
     * Export to array
     *
     * @param  array $options Accepted keys: except, only, include_null
     * @return array
     */
    public function toArray($options = array())
    {
        $array = get_object_vars($this);

        // default value
        !isset($options['include_null']) && $options['include_null'] = true;
        !isset($options['except']) && $options['except'] = array();
        $options['except'][] = 'resource_type';

        if (isset($options['only'])) {
            foreach ($array as $key => $value) {
                if (!in_array($key, $options['only'])) {
                    unset($array[$key]);
                }
            }
        }
        else {
            foreach ($options['except'] as $value) {
                unset($array[$value]);
            }
        }

        // nested call & remove null
        foreach ($array as $key => $value) {
            if (!$options['include_null'] && $value == null) {
                unset($array[$key]);
            } elseif ($value instanceof AbstractObject
                || $value instanceof AbstractList) {
                $array[$key] = $value->toArray();
            }
        }

        return $array;
    }

    /**
     * Populate from object
     *
     * @param  stdClass $object
     * @param  array $options
     * @return static
     * @see    static::fromArray()
     */
    public function fromObject($object, $options = array())
    {
        return $this->fromArray((array) $object, $options);
    }

    /**
     * Populate from array
     *
     * @param  array $array
     * @param  array $options Accepted keys: except
     * @return static
     */
    public function fromArray($array, $options = array())
    {
        // default options
        !isset($options['except']) && $options['except'] = array();

        foreach ($options['except'] as $value) {
            unset($array[$value]);
        }

        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * @ignore
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}