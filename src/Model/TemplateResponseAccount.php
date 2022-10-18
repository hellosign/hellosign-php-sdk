<?php
/**
 * TemplateResponseAccount
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
use ReturnTypeWillChange;

/**
 * TemplateResponseAccount Class Doc Comment
 *
 * @category Class
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 * @internal This class should not be instantiated directly
 */
class TemplateResponseAccount implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'TemplateResponseAccount';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'account_id' => 'string',
        'email_address' => 'string',
        'is_locked' => 'bool',
        'is_paid_hs' => 'bool',
        'is_paid_hf' => 'bool',
        'quotas' => '\HelloSignSDK\Model\TemplateResponseAccountQuota',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'account_id' => null,
        'email_address' => null,
        'is_locked' => null,
        'is_paid_hs' => null,
        'is_paid_hf' => null,
        'quotas' => null,
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
        'account_id' => 'account_id',
        'email_address' => 'email_address',
        'is_locked' => 'is_locked',
        'is_paid_hs' => 'is_paid_hs',
        'is_paid_hf' => 'is_paid_hf',
        'quotas' => 'quotas',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'account_id' => 'setAccountId',
        'email_address' => 'setEmailAddress',
        'is_locked' => 'setIsLocked',
        'is_paid_hs' => 'setIsPaidHs',
        'is_paid_hf' => 'setIsPaidHf',
        'quotas' => 'setQuotas',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'account_id' => 'getAccountId',
        'email_address' => 'getEmailAddress',
        'is_locked' => 'getIsLocked',
        'is_paid_hs' => 'getIsPaidHs',
        'is_paid_hf' => 'getIsPaidHf',
        'quotas' => 'getQuotas',
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
        $this->container['account_id'] = $data['account_id'] ?? null;
        $this->container['email_address'] = $data['email_address'] ?? null;
        $this->container['is_locked'] = $data['is_locked'] ?? null;
        $this->container['is_paid_hs'] = $data['is_paid_hs'] ?? null;
        $this->container['is_paid_hf'] = $data['is_paid_hf'] ?? null;
        $this->container['quotas'] = $data['quotas'] ?? null;
    }

    public static function fromArray(array $data): TemplateResponseAccount
    {
        /** @var TemplateResponseAccount $obj */
        $obj = ObjectSerializer::deserialize(
            ObjectSerializer::instantiateFiles(static::class, $data),
            TemplateResponseAccount::class,
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
     * Gets account_id
     *
     * @return string|null
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     *
     * @param string|null $account_id the id of the Account
     *
     * @return self
     */
    public function setAccountId(?string $account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets email_address
     *
     * @return string|null
     */
    public function getEmailAddress()
    {
        return $this->container['email_address'];
    }

    /**
     * Sets email_address
     *
     * @param string|null $email_address the email address associated with the Account
     *
     * @return self
     */
    public function setEmailAddress(?string $email_address)
    {
        $this->container['email_address'] = $email_address;

        return $this;
    }

    /**
     * Gets is_locked
     *
     * @return bool|null
     */
    public function getIsLocked()
    {
        return $this->container['is_locked'];
    }

    /**
     * Sets is_locked
     *
     * @param bool|null $is_locked returns `true` if the user has been locked out of their account by a team admin
     *
     * @return self
     */
    public function setIsLocked(?bool $is_locked)
    {
        $this->container['is_locked'] = $is_locked;

        return $this;
    }

    /**
     * Gets is_paid_hs
     *
     * @return bool|null
     */
    public function getIsPaidHs()
    {
        return $this->container['is_paid_hs'];
    }

    /**
     * Sets is_paid_hs
     *
     * @param bool|null $is_paid_hs returns `true` if the user has a paid HelloSign account
     *
     * @return self
     */
    public function setIsPaidHs(?bool $is_paid_hs)
    {
        $this->container['is_paid_hs'] = $is_paid_hs;

        return $this;
    }

    /**
     * Gets is_paid_hf
     *
     * @return bool|null
     */
    public function getIsPaidHf()
    {
        return $this->container['is_paid_hf'];
    }

    /**
     * Sets is_paid_hf
     *
     * @param bool|null $is_paid_hf returns `true` if the user has a paid HelloFax account
     *
     * @return self
     */
    public function setIsPaidHf(?bool $is_paid_hf)
    {
        $this->container['is_paid_hf'] = $is_paid_hf;

        return $this;
    }

    /**
     * Gets quotas
     *
     * @return TemplateResponseAccountQuota|null
     */
    public function getQuotas()
    {
        return $this->container['quotas'];
    }

    /**
     * Sets quotas
     *
     * @param TemplateResponseAccountQuota|null $quotas quotas
     *
     * @return self
     */
    public function setQuotas(?TemplateResponseAccountQuota $quotas)
    {
        $this->container['quotas'] = $quotas;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param mixed $offset Offset
     *
     * @return bool
     */
    #[ReturnTypeWillChange]
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
    #[ReturnTypeWillChange]
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
    #[ReturnTypeWillChange]
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
    #[ReturnTypeWillChange]
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
    #[ReturnTypeWillChange]
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
