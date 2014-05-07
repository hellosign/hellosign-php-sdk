<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
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
     * The email address of the initiator of the SignatureRequest
     *
     * @var string
     */
    protected $requester_email_address = null;

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
     * The URL where a copy of the request's documents can be downloaded
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
     * A list of email addresses that were CCed on the SignatureRequest
     *
     * They will receive a copy of the final PDF once all the signers have
     * signed.
     *
     * @var array
     */
    protected $cc_email_addresses = array();

    /**
     * An array of Custom Field objects containing the name and type of each
     * custom field
     *
     * @var array
     */
    protected $custom_fields = array();

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
     * The file(s) to send for signature
     *
     * @var array
     */
    protected $file = array();
    
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
     * @param  string $email
     * @return SignatureRequest
     * @ignore
     */
    public function setRequesterEmail($email)
    {
        $this->requester_email_address = $email;
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
     * @param  string $email
     * @return SignatureRequest
     * @ignore
     */
    public function addFile($file)
    {
        if (!file_exists($file)) {
            throw new Error('unknown', 'File does not exist');
        }

        $this->file[] = "@$file";
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
        !isset($options['except']) && $options['except'] = array();
        $options['except'] = array_merge($options['except'], array(
            'signature_request_id',
            'is_complete',
            'has_error',
            'files_url',
            'signing_url',
            'details_url',
            'custom_fields',
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

        !isset($options['except']) && $options['except'] = array();
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