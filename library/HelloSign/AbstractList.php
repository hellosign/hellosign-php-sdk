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
 * This class has basic functions to use an object as an array
 */
abstract class AbstractList implements \Iterator, \arrayaccess, \Countable
{
    /**
     * Class name of resource
     *
     * @var string
     */
    protected $resource_class = null;

    /**
     * Array of resource
     *
     * @var array
     */
    protected $collection = array();

    /**
     * Current position in array of resource
     *
     * @var integer
     */
    protected $position = 0;

    /**
     * Constructor
     *
     * @param  array $array
     * @see    static::setCollection()
     */
    public function __construct($array = array())
    {
        $this->setCollection($array);
    }

    /**
     * @ignore
     */
    public function offsetExists($offset)
    {
        return isset($this->collection[$offset]);
    }

    /**
     * @ignore
     */
    public function offsetGet($offset)
    {
        return $this->collection[$offset];
    }

    /**
     * @ignore
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->collection[] = $value;
        } else {
            $this->collection[$offset] = $value;
        }
    }

    /**
     * @ignore
     */
    public function offsetUnset($offset)
    {
        unset($this->collection[$offset]);
    }

    /**
     * @ignore
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @ignore
     */
    public function current()
    {
        return $this->collection[$this->position];
    }

    /**
     * @ignore
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @ignore
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @ignore
     */
    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    /**
     * @ignore
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * Populate collection from array
     *
     * @param  array $array
     * @return static
     */
    public function setCollection($array)
    {
        foreach ($array as $key => $object) {
            $class_name = "HelloSign\\{$this->resource_class}";
            $resource = new $class_name;
            $resource->fromObject($object);

            $this->collection[$key] = $resource;
        }

        return $this;
    }

    /**
     * Export to array
     *
     * @param  array $options Accepted keys: except, only, include_null
     * @return array
     * @see    AbstractObject::toArray()
     */
    public function toArray($options = array())
    {
        $array = array();
        foreach ($this->collection as $key => $obj) {
            $array[$key] = $obj->toArray($options);
        }

        return $array;
    }
}
