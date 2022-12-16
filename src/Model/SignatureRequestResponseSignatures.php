<?php
/**
 * SignatureRequestResponseSignatures
 *
 * PHP version 7.3
 *
 * @category Class
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 */

/**
 * Dropbox Sign API
 *
 * Dropbox Sign v3 API
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
 * SignatureRequestResponseSignatures Class Doc Comment
 *
 * @category Class
 * @description An array of signature objects, 1 for each signer.
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 * @internal This class should not be instantiated directly
 */
class SignatureRequestResponseSignatures implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'SignatureRequestResponseSignatures';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'signature_id' => 'string',
        'signer_email_address' => 'string',
        'signer_name' => 'string',
        'signer_role' => 'string',
        'order' => 'int',
        'status_code' => 'string',
        'decline_reason' => 'string',
        'signed_at' => 'int',
        'last_viewed_at' => 'int',
        'last_reminded_at' => 'int',
        'has_pin' => 'bool',
        'has_sms_auth' => 'bool',
        'has_sms_delivery' => 'bool',
        'sms_phone_number' => 'string',
        'reassigned_by' => 'string',
        'reassignment_reason' => 'string',
        'reassigned_from' => 'string',
        'error' => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'signature_id' => null,
        'signer_email_address' => null,
        'signer_name' => null,
        'signer_role' => null,
        'order' => null,
        'status_code' => null,
        'decline_reason' => null,
        'signed_at' => null,
        'last_viewed_at' => null,
        'last_reminded_at' => null,
        'has_pin' => null,
        'has_sms_auth' => null,
        'has_sms_delivery' => null,
        'sms_phone_number' => null,
        'reassigned_by' => null,
        'reassignment_reason' => null,
        'reassigned_from' => null,
        'error' => null,
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
        'signature_id' => 'signature_id',
        'signer_email_address' => 'signer_email_address',
        'signer_name' => 'signer_name',
        'signer_role' => 'signer_role',
        'order' => 'order',
        'status_code' => 'status_code',
        'decline_reason' => 'decline_reason',
        'signed_at' => 'signed_at',
        'last_viewed_at' => 'last_viewed_at',
        'last_reminded_at' => 'last_reminded_at',
        'has_pin' => 'has_pin',
        'has_sms_auth' => 'has_sms_auth',
        'has_sms_delivery' => 'has_sms_delivery',
        'sms_phone_number' => 'sms_phone_number',
        'reassigned_by' => 'reassigned_by',
        'reassignment_reason' => 'reassignment_reason',
        'reassigned_from' => 'reassigned_from',
        'error' => 'error',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'signature_id' => 'setSignatureId',
        'signer_email_address' => 'setSignerEmailAddress',
        'signer_name' => 'setSignerName',
        'signer_role' => 'setSignerRole',
        'order' => 'setOrder',
        'status_code' => 'setStatusCode',
        'decline_reason' => 'setDeclineReason',
        'signed_at' => 'setSignedAt',
        'last_viewed_at' => 'setLastViewedAt',
        'last_reminded_at' => 'setLastRemindedAt',
        'has_pin' => 'setHasPin',
        'has_sms_auth' => 'setHasSmsAuth',
        'has_sms_delivery' => 'setHasSmsDelivery',
        'sms_phone_number' => 'setSmsPhoneNumber',
        'reassigned_by' => 'setReassignedBy',
        'reassignment_reason' => 'setReassignmentReason',
        'reassigned_from' => 'setReassignedFrom',
        'error' => 'setError',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'signature_id' => 'getSignatureId',
        'signer_email_address' => 'getSignerEmailAddress',
        'signer_name' => 'getSignerName',
        'signer_role' => 'getSignerRole',
        'order' => 'getOrder',
        'status_code' => 'getStatusCode',
        'decline_reason' => 'getDeclineReason',
        'signed_at' => 'getSignedAt',
        'last_viewed_at' => 'getLastViewedAt',
        'last_reminded_at' => 'getLastRemindedAt',
        'has_pin' => 'getHasPin',
        'has_sms_auth' => 'getHasSmsAuth',
        'has_sms_delivery' => 'getHasSmsDelivery',
        'sms_phone_number' => 'getSmsPhoneNumber',
        'reassigned_by' => 'getReassignedBy',
        'reassignment_reason' => 'getReassignmentReason',
        'reassigned_from' => 'getReassignedFrom',
        'error' => 'getError',
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
        $this->container['signature_id'] = $data['signature_id'] ?? null;
        $this->container['signer_email_address'] = $data['signer_email_address'] ?? null;
        $this->container['signer_name'] = $data['signer_name'] ?? null;
        $this->container['signer_role'] = $data['signer_role'] ?? null;
        $this->container['order'] = $data['order'] ?? null;
        $this->container['status_code'] = $data['status_code'] ?? null;
        $this->container['decline_reason'] = $data['decline_reason'] ?? null;
        $this->container['signed_at'] = $data['signed_at'] ?? null;
        $this->container['last_viewed_at'] = $data['last_viewed_at'] ?? null;
        $this->container['last_reminded_at'] = $data['last_reminded_at'] ?? null;
        $this->container['has_pin'] = $data['has_pin'] ?? null;
        $this->container['has_sms_auth'] = $data['has_sms_auth'] ?? null;
        $this->container['has_sms_delivery'] = $data['has_sms_delivery'] ?? null;
        $this->container['sms_phone_number'] = $data['sms_phone_number'] ?? null;
        $this->container['reassigned_by'] = $data['reassigned_by'] ?? null;
        $this->container['reassignment_reason'] = $data['reassignment_reason'] ?? null;
        $this->container['reassigned_from'] = $data['reassigned_from'] ?? null;
        $this->container['error'] = $data['error'] ?? null;
    }

    public static function fromArray(array $data): SignatureRequestResponseSignatures
    {
        /** @var SignatureRequestResponseSignatures $obj */
        $obj = ObjectSerializer::deserialize(
            $data,
            SignatureRequestResponseSignatures::class,
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
     * Gets signature_id
     *
     * @return string|null
     */
    public function getSignatureId()
    {
        return $this->container['signature_id'];
    }

    /**
     * Sets signature_id
     *
     * @param string|null $signature_id signature identifier
     *
     * @return self
     */
    public function setSignatureId(?string $signature_id)
    {
        $this->container['signature_id'] = $signature_id;

        return $this;
    }

    /**
     * Gets signer_email_address
     *
     * @return string|null
     */
    public function getSignerEmailAddress()
    {
        return $this->container['signer_email_address'];
    }

    /**
     * Sets signer_email_address
     *
     * @param string|null $signer_email_address the email address of the signer
     *
     * @return self
     */
    public function setSignerEmailAddress(?string $signer_email_address)
    {
        $this->container['signer_email_address'] = $signer_email_address;

        return $this;
    }

    /**
     * Gets signer_name
     *
     * @return string|null
     */
    public function getSignerName()
    {
        return $this->container['signer_name'];
    }

    /**
     * Sets signer_name
     *
     * @param string|null $signer_name the name of the signer
     *
     * @return self
     */
    public function setSignerName(?string $signer_name)
    {
        $this->container['signer_name'] = $signer_name;

        return $this;
    }

    /**
     * Gets signer_role
     *
     * @return string|null
     */
    public function getSignerRole()
    {
        return $this->container['signer_role'];
    }

    /**
     * Sets signer_role
     *
     * @param string|null $signer_role the role of the signer
     *
     * @return self
     */
    public function setSignerRole(?string $signer_role)
    {
        $this->container['signer_role'] = $signer_role;

        return $this;
    }

    /**
     * Gets order
     *
     * @return int|null
     */
    public function getOrder()
    {
        return $this->container['order'];
    }

    /**
     * Sets order
     *
     * @param int|null $order if signer order is assigned this is the 0-based index for this signer
     *
     * @return self
     */
    public function setOrder(?int $order)
    {
        $this->container['order'] = $order;

        return $this;
    }

    /**
     * Gets status_code
     *
     * @return string|null
     */
    public function getStatusCode()
    {
        return $this->container['status_code'];
    }

    /**
     * Sets status_code
     *
     * @param string|null $status_code The current status of the signature. eg: awaiting_signature, signed, declined.
     *
     * @return self
     */
    public function setStatusCode(?string $status_code)
    {
        $this->container['status_code'] = $status_code;

        return $this;
    }

    /**
     * Gets decline_reason
     *
     * @return string|null
     */
    public function getDeclineReason()
    {
        return $this->container['decline_reason'];
    }

    /**
     * Sets decline_reason
     *
     * @param string|null $decline_reason the reason provided by the signer for declining the request
     *
     * @return self
     */
    public function setDeclineReason(?string $decline_reason)
    {
        $this->container['decline_reason'] = $decline_reason;

        return $this;
    }

    /**
     * Gets signed_at
     *
     * @return int|null
     */
    public function getSignedAt()
    {
        return $this->container['signed_at'];
    }

    /**
     * Sets signed_at
     *
     * @param int|null $signed_at time that the document was signed or null
     *
     * @return self
     */
    public function setSignedAt(?int $signed_at)
    {
        $this->container['signed_at'] = $signed_at;

        return $this;
    }

    /**
     * Gets last_viewed_at
     *
     * @return int|null
     */
    public function getLastViewedAt()
    {
        return $this->container['last_viewed_at'];
    }

    /**
     * Sets last_viewed_at
     *
     * @param int|null $last_viewed_at the time that the document was last viewed by this signer or null
     *
     * @return self
     */
    public function setLastViewedAt(?int $last_viewed_at)
    {
        $this->container['last_viewed_at'] = $last_viewed_at;

        return $this;
    }

    /**
     * Gets last_reminded_at
     *
     * @return int|null
     */
    public function getLastRemindedAt()
    {
        return $this->container['last_reminded_at'];
    }

    /**
     * Sets last_reminded_at
     *
     * @param int|null $last_reminded_at the time the last reminder email was sent to the signer or null
     *
     * @return self
     */
    public function setLastRemindedAt(?int $last_reminded_at)
    {
        $this->container['last_reminded_at'] = $last_reminded_at;

        return $this;
    }

    /**
     * Gets has_pin
     *
     * @return bool|null
     */
    public function getHasPin()
    {
        return $this->container['has_pin'];
    }

    /**
     * Sets has_pin
     *
     * @param bool|null $has_pin boolean to indicate whether this signature requires a PIN to access
     *
     * @return self
     */
    public function setHasPin(?bool $has_pin)
    {
        $this->container['has_pin'] = $has_pin;

        return $this;
    }

    /**
     * Gets has_sms_auth
     *
     * @return bool|null
     */
    public function getHasSmsAuth()
    {
        return $this->container['has_sms_auth'];
    }

    /**
     * Sets has_sms_auth
     *
     * @param bool|null $has_sms_auth boolean to indicate whether this signature has SMS authentication enabled
     *
     * @return self
     */
    public function setHasSmsAuth(?bool $has_sms_auth)
    {
        $this->container['has_sms_auth'] = $has_sms_auth;

        return $this;
    }

    /**
     * Gets has_sms_delivery
     *
     * @return bool|null
     */
    public function getHasSmsDelivery()
    {
        return $this->container['has_sms_delivery'];
    }

    /**
     * Sets has_sms_delivery
     *
     * @param bool|null $has_sms_delivery boolean to indicate whether this signature has SMS delivery enabled
     *
     * @return self
     */
    public function setHasSmsDelivery(?bool $has_sms_delivery)
    {
        $this->container['has_sms_delivery'] = $has_sms_delivery;

        return $this;
    }

    /**
     * Gets sms_phone_number
     *
     * @return string|null
     */
    public function getSmsPhoneNumber()
    {
        return $this->container['sms_phone_number'];
    }

    /**
     * Sets sms_phone_number
     *
     * @param string|null $sms_phone_number the SMS phone number used for authentication or signature request delivery
     *
     * @return self
     */
    public function setSmsPhoneNumber(?string $sms_phone_number)
    {
        $this->container['sms_phone_number'] = $sms_phone_number;

        return $this;
    }

    /**
     * Gets reassigned_by
     *
     * @return string|null
     */
    public function getReassignedBy()
    {
        return $this->container['reassigned_by'];
    }

    /**
     * Sets reassigned_by
     *
     * @param string|null $reassigned_by email address of original signer who reassigned to this signer
     *
     * @return self
     */
    public function setReassignedBy(?string $reassigned_by)
    {
        $this->container['reassigned_by'] = $reassigned_by;

        return $this;
    }

    /**
     * Gets reassignment_reason
     *
     * @return string|null
     */
    public function getReassignmentReason()
    {
        return $this->container['reassignment_reason'];
    }

    /**
     * Sets reassignment_reason
     *
     * @param string|null $reassignment_reason reason provided by original signer who reassigned to this signer
     *
     * @return self
     */
    public function setReassignmentReason(?string $reassignment_reason)
    {
        $this->container['reassignment_reason'] = $reassignment_reason;

        return $this;
    }

    /**
     * Gets reassigned_from
     *
     * @return string|null
     */
    public function getReassignedFrom()
    {
        return $this->container['reassigned_from'];
    }

    /**
     * Sets reassigned_from
     *
     * @param string|null $reassigned_from previous signature identifier
     *
     * @return self
     */
    public function setReassignedFrom(?string $reassigned_from)
    {
        $this->container['reassigned_from'] = $reassigned_from;

        return $this;
    }

    /**
     * Gets error
     *
     * @return string|null
     */
    public function getError()
    {
        return $this->container['error'];
    }

    /**
     * Sets error
     *
     * @param string|null $error error message pertaining to this signer, or null
     *
     * @return self
     */
    public function setError(?string $error)
    {
        $this->container['error'] = $error;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param mixed $offset Offset
     *
     * @return bool
     */
    #[\ReturnTypeWillChange]
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
    #[\ReturnTypeWillChange]
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
    #[\ReturnTypeWillChange]
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
    #[\ReturnTypeWillChange]
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
    #[\ReturnTypeWillChange]
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
