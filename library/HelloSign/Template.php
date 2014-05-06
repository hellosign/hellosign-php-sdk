<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Model object that represents a HelloSign Template resource
 */
class Template extends AbstractResource
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'template';

    /**
     * The id of the ReusableForm
     *
     * @var string
     */
    protected $template_id;

    /**
     * The title of the ReusableForm
     *
     * This will also be the default subject of the message sent to signers
     * when using this ReusableForm to send a SignatureRequest. This can be
     * overriden when sending the SignatureRequest.
     *
     * @var string
     */
    protected $title;

    /**
     * The default message that will be sent to signers when using this
     * ReusableForm to send a SignatureRequest. This can be overriden when
     * sending the SignatureRequest.
     *
     * @var string
     */
    protected $message;

    /**
     * You are creator of template or not
     *
     * @var boolean
     */
    protected $is_creator = false;

    /**
     * You can edit template or not
     *
     * @var boolean
     */
    protected $can_edit = false;

    /**
     * An array of the designated signer roles that must be specified when
     * sending a SignatureRequest using this ReusableForm
     *
     * @var array
     */
    protected $signer_roles = array();

    /**
     * An array of the designated CC roles that must be specified when sending
     * a SignatureRequest using this ReusableForm
     *
     * @var array
     */
    protected $cc_roles = array();

    /**
     * An array describing each document associated with this ReusableForm.
     * Includes form field data for each document.
     *
     * @var array
     */
    protected $documents = array();

    /**
     * An array of Custom Field objects containing the name and type of each
     * custom field
     *
     * @var array
     */
    protected $custom_fields = array();

    /**
     * An array of the Accounts that can use this ReusableForm
     *
     * @var array
     */
    protected $accounts = array();

    /**
     * @return string
     * @ignore
     */
    public function getId()
    {
        return $this->template_id;
    }

    /**
     * @return string
     * @ignore
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     * @ignore
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return array
     * @ignore
     */
    public function getSignerRoles()
    {
        return $this->signer_roles;
    }

    /**
     * @return array
     * @ignore
     */
    public function getCCRoles()
    {
        return $this->cc_roles;
    }

    /**
     * @return array
     * @ignore
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @return array
     * @ignore
     */
    public function getCustomFields()
    {
        return $this->custom_fields;
    }

    /**
     * @return array
     * @ignore
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function canEdit()
    {
        return $this->can_edit;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function isCreator()
    {
        return $this->is_creator;
    }

    /**
     * @param  stdClass $array
     * @param  array $options
     * @return Template
     * @ignore
     */
    public function fromArray($array, $options = array())
    {
        !isset($options['except']) && $options['except'] = array();
        $options['except'][] = 'named_form_fields';

        return parent::fromArray($array, $options);
    }
}