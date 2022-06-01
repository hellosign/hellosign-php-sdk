<?php
/**
 * TemplateResponseNamedFormField
 *
 * PHP version 7.3
 *
 * @category Class
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 */

/**
 * HelloSign API
 *
 * HelloSign v3 API
 *
 * The version of the OpenAPI document: 3.0.0
 * Contact: apisupport@hellosign.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace HelloSignSDK\Model;

use ArrayAccess;
use HelloSignSDK\ObjectSerializer;
use JsonSerializable;

/**
 * TemplateResponseNamedFormField Class Doc Comment
 *
 * @category Class
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 * @internal This class should not be instantiated directly
 */
class TemplateResponseNamedFormField implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'TemplateResponseNamedFormField';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'name' => 'string',
        'type' => 'string',
        'signer' => 'string',
        'x' => 'int',
        'y' => 'int',
        'width' => 'int',
        'height' => 'int',
        'required' => 'bool',
        'api_id' => 'string',
        'group' => 'string',
        'avg_text_length' => '\HelloSignSDK\Model\TemplateResponseFieldAvgTextLength',
        'is_multiline' => 'bool',
        'original_font_size' => 'int',
        'font_family' => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'name' => null,
        'type' => null,
        'signer' => null,
        'x' => null,
        'y' => null,
        'width' => null,
        'height' => null,
        'required' => null,
        'api_id' => null,
        'group' => null,
        'avg_text_length' => null,
        'is_multiline' => null,
        'original_font_size' => null,
        'font_family' => null,
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'name' => 'name',
        'type' => 'type',
        'signer' => 'signer',
        'x' => 'x',
        'y' => 'y',
        'width' => 'width',
        'height' => 'height',
        'required' => 'required',
        'api_id' => 'api_id',
        'group' => 'group',
        'avg_text_length' => 'avg_text_length',
        'is_multiline' => 'isMultiline',
        'original_font_size' => 'originalFontSize',
        'font_family' => 'fontFamily',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'type' => 'setType',
        'signer' => 'setSigner',
        'x' => 'setX',
        'y' => 'setY',
        'width' => 'setWidth',
        'height' => 'setHeight',
        'required' => 'setRequired',
        'api_id' => 'setApiId',
        'group' => 'setGroup',
        'avg_text_length' => 'setAvgTextLength',
        'is_multiline' => 'setIsMultiline',
        'original_font_size' => 'setOriginalFontSize',
        'font_family' => 'setFontFamily',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'type' => 'getType',
        'signer' => 'getSigner',
        'x' => 'getX',
        'y' => 'getY',
        'width' => 'getWidth',
        'height' => 'getHeight',
        'required' => 'getRequired',
        'api_id' => 'getApiId',
        'group' => 'getGroup',
        'avg_text_length' => 'getAvgTextLength',
        'is_multiline' => 'getIsMultiline',
        'original_font_size' => 'getOriginalFontSize',
        'font_family' => 'getFontFamily',
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    /**
     * Associative array for storing property values
     *
     * @var array
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param array|null $data Associated array of property values
     *                         initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['name'] = $data['name'] ?? null;
        $this->container['type'] = $data['type'] ?? null;
        $this->container['signer'] = $data['signer'] ?? null;
        $this->container['x'] = $data['x'] ?? null;
        $this->container['y'] = $data['y'] ?? null;
        $this->container['width'] = $data['width'] ?? null;
        $this->container['height'] = $data['height'] ?? null;
        $this->container['required'] = $data['required'] ?? null;
        $this->container['api_id'] = $data['api_id'] ?? null;
        $this->container['group'] = $data['group'] ?? null;
        $this->container['avg_text_length'] = $data['avg_text_length'] ?? null;
        $this->container['is_multiline'] = $data['is_multiline'] ?? null;
        $this->container['original_font_size'] = $data['original_font_size'] ?? null;
        $this->container['font_family'] = $data['font_family'] ?? null;
    }

    public static function fromArray(array $data): TemplateResponseNamedFormField
    {
        /** @var TemplateResponseNamedFormField $obj */
        $obj = ObjectSerializer::deserialize(
            ObjectSerializer::instantiateFiles(static::class, $data),
            TemplateResponseNamedFormField::class,
        );

        return $obj;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name the name of the Named Form Field
     *
     * @return self
     */
    public function setName(?string $name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type The type of this Named Form Field. Only `text` and `checkbox` are currently supported.
     *
     * @return self
     */
    public function setType(?string $type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets signer
     *
     * @return string|null
     */
    public function getSigner()
    {
        return $this->container['signer'];
    }

    /**
     * Sets signer
     *
     * @param string|null $signer the signer of the Named Form Field
     *
     * @return self
     */
    public function setSigner(?string $signer)
    {
        $this->container['signer'] = $signer;

        return $this;
    }

    /**
     * Gets x
     *
     * @return int|null
     */
    public function getX()
    {
        return $this->container['x'];
    }

    /**
     * Sets x
     *
     * @param int|null $x the horizontal offset in pixels for this form field
     *
     * @return self
     */
    public function setX(?int $x)
    {
        $this->container['x'] = $x;

        return $this;
    }

    /**
     * Gets y
     *
     * @return int|null
     */
    public function getY()
    {
        return $this->container['y'];
    }

    /**
     * Sets y
     *
     * @param int|null $y the vertical offset in pixels for this form field
     *
     * @return self
     */
    public function setY(?int $y)
    {
        $this->container['y'] = $y;

        return $this;
    }

    /**
     * Gets width
     *
     * @return int|null
     */
    public function getWidth()
    {
        return $this->container['width'];
    }

    /**
     * Sets width
     *
     * @param int|null $width the width in pixels of this form field
     *
     * @return self
     */
    public function setWidth(?int $width)
    {
        $this->container['width'] = $width;

        return $this;
    }

    /**
     * Gets height
     *
     * @return int|null
     */
    public function getHeight()
    {
        return $this->container['height'];
    }

    /**
     * Sets height
     *
     * @param int|null $height the height in pixels of this form field
     *
     * @return self
     */
    public function setHeight(?int $height)
    {
        $this->container['height'] = $height;

        return $this;
    }

    /**
     * Gets required
     *
     * @return bool|null
     */
    public function getRequired()
    {
        return $this->container['required'];
    }

    /**
     * Sets required
     *
     * @param bool|null $required boolean showing whether or not this field is required
     *
     * @return self
     */
    public function setRequired(?bool $required)
    {
        $this->container['required'] = $required;

        return $this;
    }

    /**
     * Gets api_id
     *
     * @return string|null
     */
    public function getApiId()
    {
        return $this->container['api_id'];
    }

    /**
     * Sets api_id
     *
     * @param string|null $api_id the unique ID for this field
     *
     * @return self
     */
    public function setApiId(?string $api_id)
    {
        $this->container['api_id'] = $api_id;

        return $this;
    }

    /**
     * Gets group
     *
     * @return string|null
     */
    public function getGroup()
    {
        return $this->container['group'];
    }

    /**
     * Sets group
     *
     * @param string|null $group The name of the group this field is in. If this field is not a group, this defaults to `null`.
     *
     * @return self
     */
    public function setGroup(?string $group)
    {
        $this->container['group'] = $group;

        return $this;
    }

    /**
     * Gets avg_text_length
     *
     * @return TemplateResponseFieldAvgTextLength|null
     */
    public function getAvgTextLength()
    {
        return $this->container['avg_text_length'];
    }

    /**
     * Sets avg_text_length
     *
     * @param TemplateResponseFieldAvgTextLength|null $avg_text_length avg_text_length
     *
     * @return self
     */
    public function setAvgTextLength(?TemplateResponseFieldAvgTextLength $avg_text_length)
    {
        $this->container['avg_text_length'] = $avg_text_length;

        return $this;
    }

    /**
     * Gets is_multiline
     *
     * @return bool|null
     */
    public function getIsMultiline()
    {
        return $this->container['is_multiline'];
    }

    /**
     * Sets is_multiline
     *
     * @param bool|null $is_multiline whether this form field is multiline text
     *
     * @return self
     */
    public function setIsMultiline(?bool $is_multiline)
    {
        $this->container['is_multiline'] = $is_multiline;

        return $this;
    }

    /**
     * Gets original_font_size
     *
     * @return int|null
     */
    public function getOriginalFontSize()
    {
        return $this->container['original_font_size'];
    }

    /**
     * Sets original_font_size
     *
     * @param int|null $original_font_size original font size used in this form field's text
     *
     * @return self
     */
    public function setOriginalFontSize(?int $original_font_size)
    {
        $this->container['original_font_size'] = $original_font_size;

        return $this;
    }

    /**
     * Gets font_family
     *
     * @return string|null
     */
    public function getFontFamily()
    {
        return $this->container['font_family'];
    }

    /**
     * Sets font_family
     *
     * @param string|null $font_family font family used in this form field's text
     *
     * @return self
     */
    public function setFontFamily(?string $font_family)
    {
        $this->container['font_family'] = $font_family;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param mixed $offset Offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param mixed $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param mixed $offset Offset
     * @param mixed $value Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param mixed $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @see https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return scalar|object|array|null returns data which can be serialized by json_encode(), which is a value
     *                                  of any type other than a resource
     */
    public function jsonSerialize()
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
