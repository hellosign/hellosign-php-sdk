<?php
/**
 * ApiAppResponse
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
 * ApiAppResponse Class Doc Comment
 *
 * @category Class
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 * @internal This class should not be instantiated directly
 */
class ApiAppResponse implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'ApiAppResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'callback_url' => 'string',
        'client_id' => 'string',
        'created_at' => 'int',
        'domain' => 'string',
        'name' => 'string',
        'is_approved' => 'bool',
        'oauth' => '\HelloSignSDK\Model\ApiAppResponseOAuth',
        'options' => '\HelloSignSDK\Model\ApiAppResponseOptions',
        'owner_account' => '\HelloSignSDK\Model\ApiAppResponseOwnerAccount',
        'white_labeling_options' => '\HelloSignSDK\Model\ApiAppResponseWhiteLabelingOptions',
        'warnings' => '\HelloSignSDK\Model\WarningResponse[]',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'callback_url' => null,
        'client_id' => null,
        'created_at' => null,
        'domain' => null,
        'name' => null,
        'is_approved' => null,
        'oauth' => null,
        'options' => null,
        'owner_account' => null,
        'white_labeling_options' => null,
        'warnings' => null,
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
        'callback_url' => 'callback_url',
        'client_id' => 'client_id',
        'created_at' => 'created_at',
        'domain' => 'domain',
        'name' => 'name',
        'is_approved' => 'is_approved',
        'oauth' => 'oauth',
        'options' => 'options',
        'owner_account' => 'owner_account',
        'white_labeling_options' => 'white_labeling_options',
        'warnings' => 'warnings',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'callback_url' => 'setCallbackUrl',
        'client_id' => 'setClientId',
        'created_at' => 'setCreatedAt',
        'domain' => 'setDomain',
        'name' => 'setName',
        'is_approved' => 'setIsApproved',
        'oauth' => 'setOauth',
        'options' => 'setOptions',
        'owner_account' => 'setOwnerAccount',
        'white_labeling_options' => 'setWhiteLabelingOptions',
        'warnings' => 'setWarnings',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'callback_url' => 'getCallbackUrl',
        'client_id' => 'getClientId',
        'created_at' => 'getCreatedAt',
        'domain' => 'getDomain',
        'name' => 'getName',
        'is_approved' => 'getIsApproved',
        'oauth' => 'getOauth',
        'options' => 'getOptions',
        'owner_account' => 'getOwnerAccount',
        'white_labeling_options' => 'getWhiteLabelingOptions',
        'warnings' => 'getWarnings',
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
        $this->container['callback_url'] = $data['callback_url'] ?? null;
        $this->container['client_id'] = $data['client_id'] ?? null;
        $this->container['created_at'] = $data['created_at'] ?? null;
        $this->container['domain'] = $data['domain'] ?? null;
        $this->container['name'] = $data['name'] ?? null;
        $this->container['is_approved'] = $data['is_approved'] ?? null;
        $this->container['oauth'] = $data['oauth'] ?? null;
        $this->container['options'] = $data['options'] ?? null;
        $this->container['owner_account'] = $data['owner_account'] ?? null;
        $this->container['white_labeling_options'] = $data['white_labeling_options'] ?? null;
        $this->container['warnings'] = $data['warnings'] ?? null;
    }

    public static function fromArray(array $data): ApiAppResponse
    {
        /** @var ApiAppResponse $obj */
        $obj = ObjectSerializer::deserialize(
            ObjectSerializer::instantiateFiles(static::class, $data),
            ApiAppResponse::class,
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
     * Gets callback_url
     *
     * @return string|null
     */
    public function getCallbackUrl()
    {
        return $this->container['callback_url'];
    }

    /**
     * Sets callback_url
     *
     * @param string|null $callback_url The app's callback URL (for events)
     *
     * @return self
     */
    public function setCallbackUrl(?string $callback_url)
    {
        $this->container['callback_url'] = $callback_url;

        return $this;
    }

    /**
     * Gets client_id
     *
     * @return string|null
     */
    public function getClientId()
    {
        return $this->container['client_id'];
    }

    /**
     * Sets client_id
     *
     * @param string|null $client_id The app's client id
     *
     * @return self
     */
    public function setClientId(?string $client_id)
    {
        $this->container['client_id'] = $client_id;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param int|null $created_at The time that the app was created
     *
     * @return self
     */
    public function setCreatedAt(?int $created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets domain
     *
     * @return string|null
     */
    public function getDomain()
    {
        return $this->container['domain'];
    }

    /**
     * Sets domain
     *
     * @param string|null $domain The domain name associated with the app
     *
     * @return self
     */
    public function setDomain(?string $domain)
    {
        $this->container['domain'] = $domain;

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
     * @param string|null $name The name of the app
     *
     * @return self
     */
    public function setName(?string $name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets is_approved
     *
     * @return bool|null
     */
    public function getIsApproved()
    {
        return $this->container['is_approved'];
    }

    /**
     * Sets is_approved
     *
     * @param bool|null $is_approved Boolean to indicate if the app has been approved
     *
     * @return self
     */
    public function setIsApproved(?bool $is_approved)
    {
        $this->container['is_approved'] = $is_approved;

        return $this;
    }

    /**
     * Gets oauth
     *
     * @return ApiAppResponseOAuth|null
     */
    public function getOauth()
    {
        return $this->container['oauth'];
    }

    /**
     * Sets oauth
     *
     * @param ApiAppResponseOAuth|null $oauth oauth
     *
     * @return self
     */
    public function setOauth(?ApiAppResponseOAuth $oauth)
    {
        $this->container['oauth'] = $oauth;

        return $this;
    }

    /**
     * Gets options
     *
     * @return ApiAppResponseOptions|null
     */
    public function getOptions()
    {
        return $this->container['options'];
    }

    /**
     * Sets options
     *
     * @param ApiAppResponseOptions|null $options options
     *
     * @return self
     */
    public function setOptions(?ApiAppResponseOptions $options)
    {
        $this->container['options'] = $options;

        return $this;
    }

    /**
     * Gets owner_account
     *
     * @return ApiAppResponseOwnerAccount|null
     */
    public function getOwnerAccount()
    {
        return $this->container['owner_account'];
    }

    /**
     * Sets owner_account
     *
     * @param ApiAppResponseOwnerAccount|null $owner_account owner_account
     *
     * @return self
     */
    public function setOwnerAccount(?ApiAppResponseOwnerAccount $owner_account)
    {
        $this->container['owner_account'] = $owner_account;

        return $this;
    }

    /**
     * Gets white_labeling_options
     *
     * @return ApiAppResponseWhiteLabelingOptions|null
     */
    public function getWhiteLabelingOptions()
    {
        return $this->container['white_labeling_options'];
    }

    /**
     * Sets white_labeling_options
     *
     * @param ApiAppResponseWhiteLabelingOptions|null $white_labeling_options white_labeling_options
     *
     * @return self
     */
    public function setWhiteLabelingOptions(?ApiAppResponseWhiteLabelingOptions $white_labeling_options)
    {
        $this->container['white_labeling_options'] = $white_labeling_options;

        return $this;
    }

    /**
     * Gets warnings
     *
     * @return WarningResponse[]|null
     */
    public function getWarnings()
    {
        return $this->container['warnings'];
    }

    /**
     * Sets warnings
     *
     * @param WarningResponse[]|null $warnings warnings
     *
     * @return self
     */
    public function setWarnings(?array $warnings)
    {
        $this->container['warnings'] = $warnings;

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
