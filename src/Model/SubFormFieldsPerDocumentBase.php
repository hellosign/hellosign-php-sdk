<?php
/**
 * SubFormFieldsPerDocumentBase
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
 * SubFormFieldsPerDocumentBase Class Doc Comment
 *
 * @category Class
 * @description The fields that should appear on the document, expressed as an array of objects.  **NOTE**: Fields like **text**, **dropdown**, **checkbox**, **radio**, and **hyperlink** have additional required and optional parameters. Check out the list of [additional parameters](/api/reference/constants/#form-fields-per-document) for these field types.  * Text Field use &#x60;SubFormFieldsPerDocumentText&#x60; * Dropdown Field use &#x60;SubFormFieldsPerDocumentDropdown&#x60; * Hyperlink Field use &#x60;SubFormFieldsPerDocumentHyperlink&#x60; * Checkbox Field use &#x60;SubFormFieldsPerDocumentCheckbox&#x60; * Radio Field use &#x60;SubFormFieldsPerDocumentRadio&#x60; * Signature Field use &#x60;SubFormFieldsPerDocumentSignature&#x60; * Date Signed Field use &#x60;SubFormFieldsPerDocumentDateSigned&#x60; * Initials Field use &#x60;SubFormFieldsPerDocumentInitials&#x60; * Text Merge Field use &#x60;SubFormFieldsPerDocumentTextMerge&#x60; * Checkbox Merge Field use &#x60;SubFormFieldsPerDocumentCheckboxMerge&#x60;
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 * @internal This class should not be instantiated directly
 */
abstract class SubFormFieldsPerDocumentBase implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = 'type';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'SubFormFieldsPerDocumentBase';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'document_index' => 'int',
        'api_id' => 'string',
        'height' => 'int',
        'page' => 'int',
        'required' => 'bool',
        'signer' => 'string',
        'type' => 'string',
        'width' => 'int',
        'x' => 'int',
        'y' => 'int',
        'name' => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'document_index' => null,
        'api_id' => null,
        'height' => null,
        'page' => null,
        'required' => null,
        'signer' => null,
        'type' => null,
        'width' => null,
        'x' => null,
        'y' => null,
        'name' => null,
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
        'document_index' => 'document_index',
        'api_id' => 'api_id',
        'height' => 'height',
        'page' => 'page',
        'required' => 'required',
        'signer' => 'signer',
        'type' => 'type',
        'width' => 'width',
        'x' => 'x',
        'y' => 'y',
        'name' => 'name',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'document_index' => 'setDocumentIndex',
        'api_id' => 'setApiId',
        'height' => 'setHeight',
        'page' => 'setPage',
        'required' => 'setRequired',
        'signer' => 'setSigner',
        'type' => 'setType',
        'width' => 'setWidth',
        'x' => 'setX',
        'y' => 'setY',
        'name' => 'setName',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'document_index' => 'getDocumentIndex',
        'api_id' => 'getApiId',
        'height' => 'getHeight',
        'page' => 'getPage',
        'required' => 'getRequired',
        'signer' => 'getSigner',
        'type' => 'getType',
        'width' => 'getWidth',
        'x' => 'getX',
        'y' => 'getY',
        'name' => 'getName',
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
        $this->container['document_index'] = $data['document_index'] ?? null;
        $this->container['api_id'] = $data['api_id'] ?? null;
        $this->container['height'] = $data['height'] ?? null;
        $this->container['page'] = $data['page'] ?? null;
        $this->container['required'] = $data['required'] ?? null;
        $this->container['signer'] = $data['signer'] ?? null;
        $this->container['type'] = $data['type'] ?? null;
        $this->container['width'] = $data['width'] ?? null;
        $this->container['x'] = $data['x'] ?? null;
        $this->container['y'] = $data['y'] ?? null;
        $this->container['name'] = $data['name'] ?? null;

        // Initialize discriminator property with the model name.
        $this->container['type'] = static::$openAPIModelName;
    }

    public static function discriminatorClassName(array $data): ?string
    {
        if (!array_key_exists('type', $data)) {
            return null;
        }

        if ($data['type'] === 'checkbox') {
            return SubFormFieldsPerDocumentCheckbox::class;
        }
        if ($data['type'] === 'checkbox-merge') {
            return SubFormFieldsPerDocumentCheckboxMerge::class;
        }
        if ($data['type'] === 'date_signed') {
            return SubFormFieldsPerDocumentDateSigned::class;
        }
        if ($data['type'] === 'dropdown') {
            return SubFormFieldsPerDocumentDropdown::class;
        }
        if ($data['type'] === 'hyperlink') {
            return SubFormFieldsPerDocumentHyperlink::class;
        }
        if ($data['type'] === 'initials') {
            return SubFormFieldsPerDocumentInitials::class;
        }
        if ($data['type'] === 'radio') {
            return SubFormFieldsPerDocumentRadio::class;
        }
        if ($data['type'] === 'signature') {
            return SubFormFieldsPerDocumentSignature::class;
        }
        if ($data['type'] === 'text') {
            return SubFormFieldsPerDocumentText::class;
        }
        if ($data['type'] === 'text-merge') {
            return SubFormFieldsPerDocumentTextMerge::class;
        }

        return null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['document_index'] === null) {
            $invalidProperties[] = "'document_index' can't be null";
        }
        if ($this->container['api_id'] === null) {
            $invalidProperties[] = "'api_id' can't be null";
        }
        if ($this->container['height'] === null) {
            $invalidProperties[] = "'height' can't be null";
        }
        if ($this->container['page'] === null) {
            $invalidProperties[] = "'page' can't be null";
        }
        if ($this->container['required'] === null) {
            $invalidProperties[] = "'required' can't be null";
        }
        if ($this->container['signer'] === null) {
            $invalidProperties[] = "'signer' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        if ($this->container['width'] === null) {
            $invalidProperties[] = "'width' can't be null";
        }
        if ($this->container['x'] === null) {
            $invalidProperties[] = "'x' can't be null";
        }
        if ($this->container['y'] === null) {
            $invalidProperties[] = "'y' can't be null";
        }

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
     * Gets document_index
     *
     * @return int
     */
    public function getDocumentIndex()
    {
        return $this->container['document_index'];
    }

    /**
     * Sets document_index
     *
     * @param int $document_index represents the integer index of the `file` or `file_url` document the field should be attached to
     *
     * @return self
     */
    public function setDocumentIndex(int $document_index)
    {
        $this->container['document_index'] = $document_index;

        return $this;
    }

    /**
     * Gets api_id
     *
     * @return string
     */
    public function getApiId()
    {
        return $this->container['api_id'];
    }

    /**
     * Sets api_id
     *
     * @param string $api_id an identifier for the field that is unique across all documents in the request
     *
     * @return self
     */
    public function setApiId(string $api_id)
    {
        $this->container['api_id'] = $api_id;

        return $this;
    }

    /**
     * Gets height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->container['height'];
    }

    /**
     * Sets height
     *
     * @param int $height size of the field in pixels
     *
     * @return self
     */
    public function setHeight(int $height)
    {
        $this->container['height'] = $height;

        return $this;
    }

    /**
     * Gets page
     *
     * @return int
     */
    public function getPage()
    {
        return $this->container['page'];
    }

    /**
     * Sets page
     *
     * @param int $page Page in the document where the field should be placed (requires documents be PDF files).  - When the page number parameter is supplied, the API will use the new coordinate system. - Check out the differences between both [coordinate systems](https://faq.hellosign.com/hc/en-us/articles/217115577) and how to use them.
     *
     * @return self
     */
    public function setPage(int $page)
    {
        $this->container['page'] = $page;

        return $this;
    }

    /**
     * Gets required
     *
     * @return bool
     */
    public function getRequired()
    {
        return $this->container['required'];
    }

    /**
     * Sets required
     *
     * @param bool $required whether this field is required
     *
     * @return self
     */
    public function setRequired(bool $required)
    {
        $this->container['required'] = $required;

        return $this;
    }

    /**
     * Gets signer
     *
     * @return string
     */
    public function getSigner()
    {
        return $this->container['signer'];
    }

    /**
     * Sets signer
     *
     * @param string $signer Signer index identified by the offset in the signers parameter (0-based indexing), indicating which signer should fill out the field.  **NOTE**: If type is `text-merge` or `checkbox-merge`, you must set this to sender in order to use pre-filled data.
     *
     * @return self
     */
    public function setSigner(string $signer)
    {
        $this->container['signer'] = $signer;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return self
     */
    public function setType(string $type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->container['width'];
    }

    /**
     * Sets width
     *
     * @param int $width size of the field in pixels
     *
     * @return self
     */
    public function setWidth(int $width)
    {
        $this->container['width'] = $width;

        return $this;
    }

    /**
     * Gets x
     *
     * @return int
     */
    public function getX()
    {
        return $this->container['x'];
    }

    /**
     * Sets x
     *
     * @param int $x location coordinates of the field in pixels
     *
     * @return self
     */
    public function setX(int $x)
    {
        $this->container['x'] = $x;

        return $this;
    }

    /**
     * Gets y
     *
     * @return int
     */
    public function getY()
    {
        return $this->container['y'];
    }

    /**
     * Sets y
     *
     * @param int $y location coordinates of the field in pixels
     *
     * @return self
     */
    public function setY(int $y)
    {
        $this->container['y'] = $y;

        return $this;
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
     * @param string|null $name display name for the field
     *
     * @return self
     */
    public function setName(?string $name)
    {
        $this->container['name'] = $name;

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
