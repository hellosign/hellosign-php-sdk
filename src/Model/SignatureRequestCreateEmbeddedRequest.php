<?php
/**
 * SignatureRequestCreateEmbeddedRequest
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
use InvalidArgumentException;
use JsonSerializable;
use SplFileObject;

/**
 * SignatureRequestCreateEmbeddedRequest Class Doc Comment
 *
 * @category Class
 * @description Calls SignatureRequestSend in controller
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class SignatureRequestCreateEmbeddedRequest implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'SignatureRequestCreateEmbeddedRequest';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'client_id' => 'string',
        'file' => '\SplFileObject[]',
        'file_url' => 'string[]',
        'allow_decline' => 'bool',
        'allow_reassign' => 'bool',
        'attachments' => '\HelloSignSDK\Model\SubAttachment[]',
        'cc_email_addresses' => 'string[]',
        'custom_fields' => '\HelloSignSDK\Model\SubCustomField[]',
        'field_options' => '\HelloSignSDK\Model\SubFieldOptions',
        'form_field_groups' => '\HelloSignSDK\Model\SubFormFieldGroup[]',
        'form_field_rules' => '\HelloSignSDK\Model\SubFormFieldRule[]',
        'form_fields_per_document' => '\HelloSignSDK\Model\SubFormFieldsPerDocumentBase[][]',
        'message' => 'string',
        'metadata' => 'array<string,mixed>',
        'signers' => '\HelloSignSDK\Model\SubSignatureRequestSigner[]',
        'signing_options' => '\HelloSignSDK\Model\SubSigningOptions',
        'subject' => 'string',
        'test_mode' => 'bool',
        'title' => 'string',
        'use_text_tags' => 'bool',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'client_id' => null,
        'file' => 'binary',
        'file_url' => null,
        'allow_decline' => null,
        'allow_reassign' => null,
        'attachments' => null,
        'cc_email_addresses' => 'email',
        'custom_fields' => null,
        'field_options' => null,
        'form_field_groups' => null,
        'form_field_rules' => null,
        'form_fields_per_document' => null,
        'message' => null,
        'metadata' => null,
        'signers' => null,
        'signing_options' => null,
        'subject' => null,
        'test_mode' => null,
        'title' => null,
        'use_text_tags' => null,
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
        'client_id' => 'client_id',
        'file' => 'file',
        'file_url' => 'file_url',
        'allow_decline' => 'allow_decline',
        'allow_reassign' => 'allow_reassign',
        'attachments' => 'attachments',
        'cc_email_addresses' => 'cc_email_addresses',
        'custom_fields' => 'custom_fields',
        'field_options' => 'field_options',
        'form_field_groups' => 'form_field_groups',
        'form_field_rules' => 'form_field_rules',
        'form_fields_per_document' => 'form_fields_per_document',
        'message' => 'message',
        'metadata' => 'metadata',
        'signers' => 'signers',
        'signing_options' => 'signing_options',
        'subject' => 'subject',
        'test_mode' => 'test_mode',
        'title' => 'title',
        'use_text_tags' => 'use_text_tags',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'client_id' => 'setClientId',
        'file' => 'setFile',
        'file_url' => 'setFileUrl',
        'allow_decline' => 'setAllowDecline',
        'allow_reassign' => 'setAllowReassign',
        'attachments' => 'setAttachments',
        'cc_email_addresses' => 'setCcEmailAddresses',
        'custom_fields' => 'setCustomFields',
        'field_options' => 'setFieldOptions',
        'form_field_groups' => 'setFormFieldGroups',
        'form_field_rules' => 'setFormFieldRules',
        'form_fields_per_document' => 'setFormFieldsPerDocument',
        'message' => 'setMessage',
        'metadata' => 'setMetadata',
        'signers' => 'setSigners',
        'signing_options' => 'setSigningOptions',
        'subject' => 'setSubject',
        'test_mode' => 'setTestMode',
        'title' => 'setTitle',
        'use_text_tags' => 'setUseTextTags',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'client_id' => 'getClientId',
        'file' => 'getFile',
        'file_url' => 'getFileUrl',
        'allow_decline' => 'getAllowDecline',
        'allow_reassign' => 'getAllowReassign',
        'attachments' => 'getAttachments',
        'cc_email_addresses' => 'getCcEmailAddresses',
        'custom_fields' => 'getCustomFields',
        'field_options' => 'getFieldOptions',
        'form_field_groups' => 'getFormFieldGroups',
        'form_field_rules' => 'getFormFieldRules',
        'form_fields_per_document' => 'getFormFieldsPerDocument',
        'message' => 'getMessage',
        'metadata' => 'getMetadata',
        'signers' => 'getSigners',
        'signing_options' => 'getSigningOptions',
        'subject' => 'getSubject',
        'test_mode' => 'getTestMode',
        'title' => 'getTitle',
        'use_text_tags' => 'getUseTextTags',
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
        $this->container['client_id'] = $data['client_id'] ?? null;
        $this->container['file'] = $data['file'] ?? null;
        $this->container['file_url'] = $data['file_url'] ?? null;
        $this->container['allow_decline'] = $data['allow_decline'] ?? false;
        $this->container['allow_reassign'] = $data['allow_reassign'] ?? false;
        $this->container['attachments'] = $data['attachments'] ?? null;
        $this->container['cc_email_addresses'] = $data['cc_email_addresses'] ?? null;
        $this->container['custom_fields'] = $data['custom_fields'] ?? null;
        $this->container['field_options'] = $data['field_options'] ?? null;
        $this->container['form_field_groups'] = $data['form_field_groups'] ?? null;
        $this->container['form_field_rules'] = $data['form_field_rules'] ?? null;
        $this->container['form_fields_per_document'] = $data['form_fields_per_document'] ?? null;
        $this->container['message'] = $data['message'] ?? null;
        $this->container['metadata'] = $data['metadata'] ?? null;
        $this->container['signers'] = $data['signers'] ?? null;
        $this->container['signing_options'] = $data['signing_options'] ?? null;
        $this->container['subject'] = $data['subject'] ?? null;
        $this->container['test_mode'] = $data['test_mode'] ?? false;
        $this->container['title'] = $data['title'] ?? null;
        $this->container['use_text_tags'] = $data['use_text_tags'] ?? false;
    }

    public static function fromArray(array $data): SignatureRequestCreateEmbeddedRequest
    {
        /** @var SignatureRequestCreateEmbeddedRequest $obj */
        $obj = ObjectSerializer::deserialize(
            ObjectSerializer::instantiateFiles(static::class, $data),
            SignatureRequestCreateEmbeddedRequest::class,
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
     * Gets file
     *
     * @return SplFileObject[]|null
     */
    public function getFile()
    {
        return $this->container['file'];
    }

    /**
     * Sets file
     *
     * @param SplFileObject[]|null $file **file** or **file_url** is required, but not both.  Use `file[]` to indicate the uploaded file(s) to send for signature.  Currently we only support use of either the `file[]` parameter or `file_url[]` parameter, not both.
     *
     * @return self
     */
    public function setFile(?array $file)
    {
        $this->container['file'] = $file;

        return $this;
    }

    /**
     * Gets file_url
     *
     * @return string[]|null
     */
    public function getFileUrl()
    {
        return $this->container['file_url'];
    }

    /**
     * Sets file_url
     *
     * @param string[]|null $file_url **file_url** or **file** is required, but not both.  Use `file_url[]` to have HelloSign download the file(s) to send for signature.  Currently we only support use of either the `file[]` parameter or `file_url[]` parameter, not both.
     *
     * @return self
     */
    public function setFileUrl(?array $file_url)
    {
        $this->container['file_url'] = $file_url;

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
     * Gets allow_reassign
     *
     * @return bool|null
     */
    public function getAllowReassign()
    {
        return $this->container['allow_reassign'];
    }

    /**
     * Sets allow_reassign
     *
     * @param bool|null $allow_reassign Allows signers to reassign their signature requests to other signers if set to `true`. Defaults to `false`.  **Note**: Only available for Gold plan and higher.
     *
     * @return self
     */
    public function setAllowReassign(?bool $allow_reassign)
    {
        $this->container['allow_reassign'] = $allow_reassign;

        return $this;
    }

    /**
     * Gets attachments
     *
     * @return SubAttachment[]|null
     */
    public function getAttachments()
    {
        return $this->container['attachments'];
    }

    /**
     * Sets attachments
     *
     * @param SubAttachment[]|null $attachments attachments
     *
     * @return self
     */
    public function setAttachments(?array $attachments)
    {
        $this->container['attachments'] = $attachments;

        return $this;
    }

    /**
     * Gets cc_email_addresses
     *
     * @return string[]|null
     */
    public function getCcEmailAddresses()
    {
        return $this->container['cc_email_addresses'];
    }

    /**
     * Sets cc_email_addresses
     *
     * @param string[]|null $cc_email_addresses the email addresses that should be CCed
     *
     * @return self
     */
    public function setCcEmailAddresses(?array $cc_email_addresses)
    {
        $this->container['cc_email_addresses'] = $cc_email_addresses;

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
     * @param SubCustomField[]|null $custom_fields An array defining values and options for custom fields. Required when defining pre-set values in `form_fields_per_document` or [Text Tags](https://app.hellosign.com/api/textTagsWalkthrough#TextTagIntro).
     *
     * @return self
     */
    public function setCustomFields(?array $custom_fields)
    {
        $this->container['custom_fields'] = $custom_fields;

        return $this;
    }

    /**
     * Gets field_options
     *
     * @return SubFieldOptions|null
     */
    public function getFieldOptions()
    {
        return $this->container['field_options'];
    }

    /**
     * Sets field_options
     *
     * @param SubFieldOptions|null $field_options field_options
     *
     * @return self
     */
    public function setFieldOptions(?SubFieldOptions $field_options)
    {
        $this->container['field_options'] = $field_options;

        return $this;
    }

    /**
     * Gets form_field_groups
     *
     * @return SubFormFieldGroup[]|null
     */
    public function getFormFieldGroups()
    {
        return $this->container['form_field_groups'];
    }

    /**
     * Sets form_field_groups
     *
     * @param SubFormFieldGroup[]|null $form_field_groups Group information for fields defined in `form_fields_per_document`. String-indexed JSON array with `group_label` and `requirement` keys. `form_fields_per_document` must contain fields referencing a group defined in `form_field_groups`.
     *
     * @return self
     */
    public function setFormFieldGroups(?array $form_field_groups)
    {
        $this->container['form_field_groups'] = $form_field_groups;

        return $this;
    }

    /**
     * Gets form_field_rules
     *
     * @return SubFormFieldRule[]|null
     */
    public function getFormFieldRules()
    {
        return $this->container['form_field_rules'];
    }

    /**
     * Sets form_field_rules
     *
     * @param SubFormFieldRule[]|null $form_field_rules conditional Logic rules for fields defined in `form_fields_per_document`
     *
     * @return self
     */
    public function setFormFieldRules(?array $form_field_rules)
    {
        $this->container['form_field_rules'] = $form_field_rules;

        return $this;
    }

    /**
     * Gets form_fields_per_document
     *
     * @return SubFormFieldsPerDocumentBase[][]|null
     */
    public function getFormFieldsPerDocument()
    {
        return $this->container['form_fields_per_document'];
    }

    /**
     * Sets form_fields_per_document
     *
     * @param SubFormFieldsPerDocumentBase[][]|null $form_fields_per_document The fields that should appear on the document, expressed as a 2-dimensional JSON array serialized to a string. The main array represents documents, with each containing an array of form fields. One document array is required for each file provided by the `file[]` parameter. In the case of a file with no fields, an empty list must be specified.  **NOTE**: Fields like **text**, **dropdown**, **checkbox**, **radio**, and **hyperlink** have additional required and optional parameters. Check out the list of [additional parameters](/api/reference/constants/#form-fields-per-document) for these field types.  * Text Field use `SubFormFieldsPerDocumentText` * Dropdown Field use `SubFormFieldsPerDocumentDropdown` * Hyperlink Field use `SubFormFieldsPerDocumentHyperlink` * Checkbox Field use `SubFormFieldsPerDocumentCheckbox` * Radio Field use `SubFormFieldsPerDocumentRadio` * Signature Field use `SubFormFieldsPerDocumentSignature` * Date Signed Field use `SubFormFieldsPerDocumentDateSigned` * Initials Field use `SubFormFieldsPerDocumentInitials` * Text Merge Field use `SubFormFieldsPerDocumentTextMerge` * Checkbox Merge Field use `SubFormFieldsPerDocumentCheckboxMerge`
     *
     * @return self
     */
    public function setFormFieldsPerDocument(?array $form_fields_per_document)
    {
        $this->container['form_fields_per_document'] = $form_fields_per_document;

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
            throw new InvalidArgumentException('invalid length for $message when calling SignatureRequestCreateEmbeddedRequest., must be smaller than or equal to 5000.');
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
     * @param array<string,mixed>|null $metadata Key-value data that should be attached to the signature request. This metadata is included in all API responses and events involving the signature request. For example, use the metadata field to store a signer's order number for look up when receiving events for the signature request.  Each request can include up to 10 metadata keys, with key names up to 40 characters long and values up to 1000 characters long.
     *
     * @return self
     */
    public function setMetadata(?array $metadata)
    {
        $this->container['metadata'] = $metadata;

        return $this;
    }

    /**
     * Gets signers
     *
     * @return SubSignatureRequestSigner[]|null
     */
    public function getSigners()
    {
        return $this->container['signers'];
    }

    /**
     * Sets signers
     *
     * @param SubSignatureRequestSigner[]|null $signers add Signers to your Signature Request
     *
     * @return self
     */
    public function setSigners(?array $signers)
    {
        $this->container['signers'] = $signers;

        return $this;
    }

    /**
     * Gets signing_options
     *
     * @return SubSigningOptions|null
     */
    public function getSigningOptions()
    {
        return $this->container['signing_options'];
    }

    /**
     * Sets signing_options
     *
     * @param SubSigningOptions|null $signing_options signing_options
     *
     * @return self
     */
    public function setSigningOptions(?SubSigningOptions $signing_options)
    {
        $this->container['signing_options'] = $signing_options;

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
            throw new InvalidArgumentException('invalid length for $subject when calling SignatureRequestCreateEmbeddedRequest., must be smaller than or equal to 255.');
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
            throw new InvalidArgumentException('invalid length for $title when calling SignatureRequestCreateEmbeddedRequest., must be smaller than or equal to 255.');
        }

        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets use_text_tags
     *
     * @return bool|null
     */
    public function getUseTextTags()
    {
        return $this->container['use_text_tags'];
    }

    /**
     * Sets use_text_tags
     *
     * @param bool|null $use_text_tags Send with a value of `true` if you wish to enable [Text Tags](https://app.hellosign.com/api/textTagsWalkthrough#TextTagIntro) parsing in your document. Defaults to disabled, or `false`.
     *
     * @return self
     */
    public function setUseTextTags(?bool $use_text_tags)
    {
        $this->container['use_text_tags'] = $use_text_tags;

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
