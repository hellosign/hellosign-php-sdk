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
        if (!isset($options['include_null'])) {
          $options['include_null'] = false;
        }

        if (!isset($options['except'])) {
          $options['except'] = array();
        }

        $options['except'][] = 'resource_type';

        if (isset($options['only'])) {
            foreach ($array as $key => $value) {
                if (!in_array($key, $options['only'])) {
                    unset($array[$key]);
                }
            }
        } else {
            foreach ($options['except'] as $value) {
                unset($array[$value]);
            }
        }

        // nested call & remove null
        foreach ($array as $key => $value) {
            if (!$options['include_null'] && $value === null) {
                unset($array[$key]);
            } elseif ($value instanceof AbstractObject || $value instanceof AbstractList) {
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
        if (!isset($options['except'])) {
          $options['except'] = array();
        }

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
