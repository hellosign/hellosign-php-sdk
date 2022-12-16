<?php
/**
 * SignatureRequestBulkCreateEmbeddedWithTemplateRequest
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
use InvalidArgumentException;
use JsonSerializable;
use SplFileObject;

/**
 * SignatureRequestBulkCreateEmbeddedWithTemplateRequest Class Doc Comment
 *
 * @category Class
 * @description Calls SignatureRequestBulkSendWithTemplate in controller
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class SignatureRequestBulkCreateEmbeddedWithTemplateRequest implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'SignatureRequestBulkCreateEmbeddedWithTemplateRequest';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'template_ids' => 'string[]',
        'client_id' => 'string',
        'signer_file' => '\SplFileObject',
        'signer_list' => '\HelloSignSDK\Model\SubBulkSignerList[]',
        'allow_decline' => 'bool',
        'ccs' => '\HelloSignSDK\Model\SubCC[]',
        'custom_fields' => '\HelloSignSDK\Model\SubCustomField[]',
        'message' => 'string',
        'metadata' => 'array<string,mixed>',
        'signing_redirect_url' => 'string',
        'subject' => 'string',
        'test_mode' => 'bool',
        'title' => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'template_ids' => null,
        'client_id' => null,
        'signer_file' => 'binary',
        'signer_list' => null,
        'allow_decline' => null,
        'ccs' => null,
        'custom_fields' => null,
        'message' => null,
        'metadata' => null,
        'signing_redirect_url' => null,
        'subject' => null,
        'test_mode' => null,
        'title' => null,
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
        'template_ids' => 'template_ids',
        'client_id' => 'client_id',
        'signer_file' => 'signer_file',
        'signer_list' => 'signer_list',
        'allow_decline' => 'allow_decline',
        'ccs' => 'ccs',
        'custom_fields' => 'custom_fields',
        'message' => 'message',
        'metadata' => 'metadata',
        'signing_redirect_url' => 'signing_redirect_url',
        'subject' => 'subject',
        'test_mode' => 'test_mode',
        'title' => 'title',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'template_ids' => 'setTemplateIds',
        'client_id' => 'setClientId',
        'signer_file' => 'setSignerFile',
        'signer_list' => 'setSignerList',
        'allow_decline' => 'setAllowDecline',
        'ccs' => 'setCcs',
        'custom_fields' => 'setCustomFields',
        'message' => 'setMessage',
        'metadata' => 'setMetadata',
        'signing_redirect_url' => 'setSigningRedirectUrl',
        'subject' => 'setSubject',
        'test_mode' => 'setTestMode',
        'title' => 'setTitle',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'template_ids' => 'getTemplateIds',
        'client_id' => 'getClientId',
        'signer_file' => 'getSignerFile',
        'signer_list' => 'getSignerList',
        'allow_decline' => 'getAllowDecline',
        'ccs' => 'getCcs',
        'custom_fields' => 'getCustomFields',
        'message' => 'getMessage',
        'metadata' => 'getMetadata',
        'signing_redirect_url' => 'getSigningRedirectUrl',
        'subject' => 'getSubject',
        'test_mode' => 'getTestMode',
        'title' => 'getTitle',
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
        $this->container['template_ids'] = $data['template_ids'] ?? null;
        $this->container['client_id'] = $data['client_id'] ?? null;
        $this->container['signer_file'] = $data['signer_file'] ?? null;
        $this->container['signer_list'] = $data['signer_list'] ?? null;
        $this->container['allow_decline'] = $data['allow_decline'] ?? false;
        $this->container['ccs'] = $data['ccs'] ?? null;
        $this->container['custom_fields'] = $data['custom_fields'] ?? null;
        $this->container['message'] = $data['message'] ?? null;
        $this->container['metadata'] = $data['metadata'] ?? null;
        $this->container['signing_redirect_url'] = $data['signing_redirect_url'] ?? null;
        $this->container['subject'] = $data['subject'] ?? null;
        $this->container['test_mode'] = $data['test_mode'] ?? false;
        $this->container['title'] = $data['title'] ?? null;
    }

    public static function fromArray(array $data): SignatureRequestBulkCreateEmbeddedWithTemplateRequest
    {
        /** @var SignatureRequestBulkCreateEmbeddedWithTemplateRequest $obj */
        $obj = ObjectSerializer::deserialize(
            $data,
            SignatureRequestBulkCreateEmbeddedWithTemplateRequest::class,
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

        if ($this->container['template_ids'] === null) {
            $invalidProperties[] = "'template_ids' can't be null";
        }
        if ($this->container['client_id'] === null) {
            $invalidProperties[] = "'client_id' can't be null";
        }
        if (!is_null($this->container['message']) && (mb_strlen($this->container['message']) > 5000)) {
            $invalidProperties[] = "invalid value for 'message', the character length must be smaller than or equal to 5000.";
        }

        if (!is_null($this->container['subject']) && (mb_strlen($this->container['subject']) > 255)) {
            $invalidProperties[] = "invalid value for 'subject', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['title']) && (mb_strlen($this->container['title']) > 255)) {
            $invalidProperties[] = "invalid value for 'title', the character length must be smaller than or equal to 255.";
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
     * Gets template_ids
     *
     * @return string[]
     */
    public function getTemplateIds()
    {
        return $this->container['template_ids'];
    }

    /**
     * Sets template_ids
     *
     * @param string[] $template_ids use `template_ids` to create a SignatureRequest from one or more templates, in the order in which the template will be used
     *
     * @return self
     */
    public function setTemplateIds(array $template_ids)
    {
        $this->container['template_ids'] = $template_ids;

        return $this;
    }

    /**
     * Gets client_id
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->container['client_id'];
    }

    /**
     * Sets client_id
     *
     * @param string $client_id Client id of the app you're using to create this embedded signature request. Used for security purposes.
     *
     * @return self
     */
    public function setClientId(string $client_id)
    {
        $this->container['client_id'] = $client_id;

        return $this;
    }

    /**
     * Gets signer_file
     *
     * @return SplFileObject|null
     */
    public function getSignerFile()
    {
        return $this->container['signer_file'];
    }

    /**
     * Sets signer_file
     *
     * @param SplFileObject|null $signer_file `signer_file` is a CSV file defining values and options for signer fields. Required unless a `signer_list` is used, you may not use both. The CSV can have the following columns:  - `name`: the name of the signer filling the role of RoleName - `email_address`: email address of the signer filling the role of RoleName - `pin`: the 4- to 12-character access code that will secure this signer's signature page (optional) - `sms_phone_number`: An E.164 formatted phone number that will receive a code via SMS to access this signer's signature page. (optional)      **Note**: Not available in test mode and requires a Standard plan or higher. - `*_field`: any column with a _field\" suffix will be treated as a custom field (optional)      You may only specify field values here, any other options should be set in the custom_fields request parameter.  Example CSV:  ``` name, email_address, pin, company_field George, george@example.com, d79a3td, ABC Corp Mary, mary@example.com, gd9as5b, 123 LLC ```
     *
     * @return self
     */
    public function setSignerFile(?SplFileObject $signer_file)
    {
        $this->container['signer_file'] = $signer_file;

        return $this;
    }

    /**
     * Gets signer_list
     *
     * @return SubBulkSignerList[]|null
     */
    public function getSignerList()
    {
        return $this->container['signer_list'];
    }

    /**
     * Sets signer_list
     *
     * @param SubBulkSignerList[]|null $signer_list `signer_list` is an array defining values and options for signer fields. Required unless a `signer_file` is used, you may not use both.
     *
     * @return self
     */
    public function setSignerList(?array $signer_list)
    {
        $this->container['signer_list'] = $signer_list;

        return $this;
    }

    /**
     * Gets allow_decline
     *
     * @return bool|null
     */
    public function getAllowDecline()
    {
        return $this->container['allow_decline'];
    }

    /**
     * Sets allow_decline
     *
     * @param bool|null $allow_decline Allows signers to decline to sign a document if `true`. Defaults to `false`.
     *
     * @return self
     */
    public function setAllowDecline(?bool $allow_decline)
    {
        $this->container['allow_decline'] = $allow_decline;

        return $this;
    }

    /**
     * Gets ccs
     *
     * @return SubCC[]|null
     */
    public function getCcs()
    {
        return $this->container['ccs'];
    }

    /**
     * Sets ccs
     *
     * @param SubCC[]|null $ccs Add CC email recipients. Required when a CC role exists for the Template.
     *
     * @return self
     */
    public function setCcs(?array $ccs)
    {
        $this->container['ccs'] = $ccs;

        return $this;
    }

    /**
     * Gets custom_fields
     *
     * @return SubCustomField[]|null
     */
    public function getCustomFields()
    {
        return $this->container['custom_fields'];
    }

    /**
     * Sets custom_fields
     *
     * @param SubCustomField[]|null $custom_fields When used together with merge fields, `custom_fields` allows users to add pre-filled data to their signature requests.  Pre-filled data can be used with \"send-once\" signature requests by adding merge fields with `form_fields_per_document` or [Text Tags](https://app.hellosign.com/api/textTagsWalkthrough#TextTagIntro) while passing values back with `custom_fields` together in one API call.  For using pre-filled on repeatable signature requests, merge fields are added to templates in the Dropbox Sign UI or by calling [/template/create_embedded_draft](/api/reference/operation/templateCreateEmbeddedDraft) and then passing `custom_fields` on subsequent signature requests referencing that template.
     *
     * @return self
     */
    public function setCustomFields(?array $custom_fields)
    {
        $this->container['custom_fields'] = $custom_fields;

        return $this;
    }

    /**
     * Gets message
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param string|null $message the custom message in the email that will be sent to the signers
     *
     * @return self
     */
    public function setMessage(?string $message)
    {
        if (!is_null($message) && (mb_strlen($message) > 5000)) {
            throw new InvalidArgumentException('invalid length for $message when calling SignatureRequestBulkCreateEmbeddedWithTemplateRequest., must be smaller than or equal to 5000.');
        }

        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets metadata
     *
     * @return array<string,mixed>|null
     */
    public function getMetadata()
    {
        return $this->container['metadata'];
    }

    /**
     * Sets metadata
     *
     * @param array<string,mixed>|null $metadata Key-value data that should be attached to the signature request. This metadata is included in all API responses and events involving the signature request. For example, use the metadata field to store a signer's order number for look up when receiving events for the signature request.  Each request can include up to 10 metadata keys (or 50 nested metadata keys), with key names up to 40 characters long and values up to 1000 characters long.
     *
     * @return self
     */
    public function setMetadata(?array $metadata)
    {
        $this->container['metadata'] = $metadata;

        return $this;
    }

    /**
     * Gets signing_redirect_url
     *
     * @return string|null
     */
    public function getSigningRedirectUrl()
    {
        return $this->container['signing_redirect_url'];
    }

    /**
     * Sets signing_redirect_url
     *
     * @param string|null $signing_redirect_url the URL you want signers redirected to after they successfully sign
     *
     * @return self
     */
    public function setSigningRedirectUrl(?string $signing_redirect_url)
    {
        $this->container['signing_redirect_url'] = $signing_redirect_url;

        return $this;
    }

    /**
     * Gets subject
     *
     * @return string|null
     */
    public function getSubject()
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param string|null $subject the subject in the email that will be sent to the signers
     *
     * @return self
     */
    public function setSubject(?string $subject)
    {
        if (!is_null($subject) && (mb_strlen($subject) > 255)) {
            throw new InvalidArgumentException('invalid length for $subject when calling SignatureRequestBulkCreateEmbeddedWithTemplateRequest., must be smaller than or equal to 255.');
        }

        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets test_mode
     *
     * @return bool|null
     */
    public function getTestMode()
    {
        return $this->container['test_mode'];
    }

    /**
     * Sets test_mode
     *
     * @param bool|null $test_mode Whether this is a test, the signature request will not be legally binding if set to `true`. Defaults to `false`.
     *
     * @return self
     */
    public function setTestMode(?bool $test_mode)
    {
        $this->container['test_mode'] = $test_mode;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title the title you want to assign to the SignatureRequest
     *
     * @return self
     */
    public function setTitle(?string $title)
    {
        if (!is_null($title) && (mb_strlen($title) > 255)) {
            throw new InvalidArgumentException('invalid length for $title when calling SignatureRequestBulkCreateEmbeddedWithTemplateRequest., must be smaller than or equal to 255.');
        }

        $this->container['title'] = $title;

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
