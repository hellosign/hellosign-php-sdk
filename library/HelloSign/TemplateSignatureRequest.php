<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

use stdClass;

/**
 * Represents a HelloSign signature request based on a Template
 *
 * Unlike the SignatureRequest, this object is only used to submit
 * the request. A successfully submitted TemplateSignatureRequest will
 * return a SignatureRequest object from the server.
 */
class TemplateSignatureRequest extends AbstractSignatureRequest
{
    /**
     * The id of the ReusableForm to use when creating the SignatureRequest
     *
     * @var string
     */
    protected $template_id;

    /**
     * A list of email addresses that were CCed on the TemplateSignatureRequest
     *
     * They will receive a copy of the final PDF once all the signers have
     * signed.
     *
     * @var array
     */
    protected $ccs = array();

    /**
     * An array of Custom Field objects containing the name and type of each
     * custom field
     *
     * @var array
     */
    protected $custom_fields = array();

    /**
     * @param string $id
     * @return TemplateSignatureRequest
     * @ignore
     */
    public function setTemplateId($id)
    {
        $this->template_id = $id;
        return $this;
    }

    /**
     * Set the signer to the list of signers for this request
     *
     * @param  string $role
     * @param  mixed $email_or_signer
     * @param  string $name
     * @return TemplateSignatureRequest
     * @see    AbstractSignatureRequest::addSigner()
     */
    public function setSigner($role, $email_or_signer, $name = null)
    {
        return parent::addSigner($email_or_signer, $name, $role);
    }

    /**
    * Sets the CC email address for the provided role
    *
    * @param  string $role
    * @param  string $email
    * @return TemplateSignatureRequest
    */
    public function setCC($role, $email)
    {
        $obj = new stdClass;
        $obj->email_address = $email;

        $this->ccs[$role] = $obj;

        return $this;
    }

    /**
     * Set the value to fill in for a custom field with the given field name
     *
     * @param  string $field_name field name to be filled in
     * @param  string $value
     * @return TemplateSignatureRequest
     */
    public function setCustomFieldValue($field_name, $value)
    {
        $this->custom_fields[$field_name] = $value;
        return $this;
    }

    /**
     * @return array
     * @ignore
     */
    public function toParams()
    {
    	$except = array(
        	'use_text_tags',
    		'hide_text_tags'
        );
        return $this->toArray(array(
            'except' => $except
        ));
    }

}