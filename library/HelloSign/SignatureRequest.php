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

use stdClass;

/**
 * All HelloSign API requests can be made using HelloSign\Client class. This
 * class must be initialized with your authentication details, such as an API
 * key (preferred) or website credentials.
 */
class SignatureRequest extends AbstractSignatureRequest
{
    const FILE_TYPE_PDF = 'pdf';
    const FILE_TYPE_ZIP = 'zip';

    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'signature_request';

    /**
     * The id of the SignatureRequest
     *
     * @var string
     */
    protected $signature_request_id = null;

    /**
     * Whether or not the SignatureRequest has been fully executed by all
     * signers
     *
     * @var boolean
     */
    protected $is_complete = false;

    /**
     * Whether or not an error occurred (either during the creation of the
     * SignatureRequest or during one of the signings)
     *
     * @var boolean
     */
    protected $has_error = false;

    /**
     * The URL at which this requests files can be retrieved.
     *
     * @var string
     */
    protected $files_url = null;

    /**
     * The URL where a signer, after authenticating, can sign the documents
     *
     * @var string
     */
    protected $signing_url = null;

    /**
     * The URL where the requester and the signers can view the current status
     * of the SignatureRequest
     *
     * @var string
     */
    protected $details_url = null;

    /**
    * Whether the sender will allow the signer to reassign the SignatureRequest
    *
    * Defaults to false.
    *
    * @var boolean
    */
   protected $allow_reassign = false;

    /**
     * A list of email addresses that were CCed on the SignatureRequest
     *
     * They will receive a copy of the final PDF once all the signers have
     * signed.
     *
     * @var array
     */
    protected $cc_email_addresses = array();

    /**
     * A JSON array of Custom Field objects
     *
     * @var string
     */
    protected $custom_fields = null;

    /**
     * An array of signer attachements
     *
     * @var AttachmentList
     */
    protected $attachments = null;

    /**
     * An array of form field objects containing the name, value, and type of
     * each textbox or checkmark field filled in by the signers
     *
     * @var array
     */
    protected $response_data = null;

    /**
     * An array of signature objects, 1 for each signer
     *
     * @var SignatureList
     */
    protected $signatures = null;

    /**
     * The document fields manually specified when signing from a file. Optional
     * See: https://www.hellosign.com/api/signatureRequestWalkthrough#SignatureRequestScenarios/CreateFromFileAndComponents
     *
     * @var array
     */
    protected $form_fields_per_document = array();

    /**
     * Constructor
     *
     * @param  stdClass $response
     * @param  array $options
     * @ignore
     */
    public function __construct($response = null, $options = array())
    {
        $this->signatures = new SignatureList;

        parent::__construct($response, $options);
    }

    /**
     * @return string
     * @ignore
     */
    public function getId()
    {
        return $this->signature_request_id;
    }

    /**
     * @return SignatureRequest
     * @ignore
     */
    public function enableAllowReassign()
    {
        $this->allow_reassign = true;
        return $this;
    }

    /**
     * @return SignatureRequest
     * @ignore
     */
    public function disableAllowReassign()
    {
        $this->allow_reassign = false;
        return $this;
    }

    /**
     * @param  array $form_fields
     * @return SignatureRequest
     * @ignore
     */
    public function setFormFieldsPerDocument($form_fields)
    {
        $this->form_fields_per_document = json_encode($form_fields);
        return $this;
    }

    /**
     * Set the value for a custom field with the given field name
     * and optionally define a Role allowed to edit it and if the field is required to be filled
     *
     * @param  string $field_name field name to be filled in
     * @param  string $value
     * @param  string $editor
     * @param  string $required
     * @return SignatureRequest
     */
    public function setCustomFieldValue($field_name, $value, $editor = null, $required = null)
    {
        $custom_fields = isset($this->custom_fields) ? json_decode($this->custom_fields) : array();
        $custom_fields[] = array(
            'name'     => $field_name,
            'value'    => $value,
            'editor'   => $editor,
            'required'   => $required
        );
        $this->custom_fields = json_encode($custom_fields);
        return $this;
    }

    /**
     * @param  string $email
     * @return SignatureRequest
     * @ignore
     */
    public function addCC($email)
    {
        $this->cc_email_addresses[] = $email;
        return $this;
    }

    /**
     * Adds an Attachment to the SignatureRequest
     *
     * @param  string $name Name of the Attachment.
     * @param  integer $signer_index Index of the signer to upload this Attachment.
     * @param  string $instructions Instructions for uploading the Attachment. (optional)
     * @param  boolean $required Whether or not the signer is required to upload this Attachment. (optional)
     * @return SignatureRequest
     */
    public function addAttachment($name, $signer_index, $instructions = null, $required = null)
    {
        $attachment = new Attachment(array(
                'name' => $name,
                'instructions' => $instructions,
                'signer_index' => $signer_index,
                'required' => $required
            ));

        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * @param  array $options
     * @return array
     * @ignore
     */
    public function toParams($options = array())
    {
        // default value
        if (!isset($options['except'])) {
          $options['except'] = array();
        }

        $options['except'] = array_merge($options['except'], array(
            'signature_request_id',
            'is_complete',
            'has_error',
            'files_url',
            'signing_url',
            'details_url',
            'response_data',
            'signatures'
        ));

        // requester_email_address param only accepted in unclaimed_draft/create_embedded
        if (!$this->requester_email_address) {
            $options['except'][] = 'requester_email_address';
        }

        return $this->toArray($options);
    }

    /**
     * @param  array $array
     * @param  array $options
     * @return SignatureRequest
     * @ignore
     */
    public function fromArray($array, $options = array())
    {
        array_key_exists('signatures', $array) && $this->setSignatures($array['signatures']);

        if (!isset($options['except'])) {
          $options['except'] = array();
        }

        $options['except'] = array_merge($options['except'], array(
            'signatures',
            'original_title',
            'final_copy_uri'
        ));

        return parent::fromArray($array, $options);
    }

    /**
     * @return boolean true, if all signers have signed the document, false
     * otherwise
     * @ignore
     */
    public function isComplete()
    {
        return $this->is_complete;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasError()
    {
        return $this->has_error;
    }

    /**
     * @return SignatureList
     * @ignore
     */
    public function getSignatures()
    {
        return $this->signatures;
    }

    /**
     * @param  array $signatures
     * @return SignatureRequest
     * @ignore
     */
    protected function setSignatures($signatures)
    {
        $this->signatures->setCollection($signatures);

        return $this;
    }
}
