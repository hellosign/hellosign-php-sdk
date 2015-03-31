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
     * Client id of the app you're using to create this draft.
     *
     * @var string
     */
    protected $client_id;

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
     * Used when creating embedded draft requests - Edit URL returned from server
     *
     * @var string
     */
    protected $edit_url = null;

    /**
     * Used when creating embedded draft requests - expiry date for $edit_url
     *
     * @var integer
     */
    protected $expires_at = null;

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
     * An array of Merge Field objects containing the name and type of each
     * merge field. Used when creating embedded drafts.
     *
     * @var array
     */
    protected $merge_fields = array();

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

    /* Setters for Create Embedded Draft */

    /**
     * @param string $id clientID
     * @return boolean
     * @ignore
     */
    public function setClientId($id)
    {
        $this->client_id = $id;
        return true;
    }

    /**
     * @param string $role role name
     * @param integer $order optional, signer order
     * @return boolean
     * @ignore
     */
    public function addSignerRole($role, $order = null)
    {
        $this->signer_roles[] = array(
            'name' => $role,
            'order' => $order
        );
        return true;
    }

    /**
     * @param string $role role name
     * @return boolean
     * @ignore
     */
    public function addCCRole($role)
    {
        $this->cc_roles[] = $role;
        return true;
    }

    /**
     * @param string $name field name
     * @param string $type field type
     * @return boolean
     * @ignore
     */
    public function addMergeField($name, $type = 'text')
    {
        $this->merge_fields[] = array(
            'name' => $name,
            'type' => $type
        );
        return true;
    }

    /**
     * @return string
     * @ignore
     */
    public function getEditUrl()
    {
        return $this->edit_url;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * @return bool
     * @ignore
     */
    public function isEmbeddedDraft()
    {
        return isset($this->edit_url);
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

    /**
     * @return array
     * @ignore
     */
    public function toEmbeddedDraftParams()
    {
        $fields_to_include = array(
            'test_mode',
            'client_id',
            'file',
            'file_url',
            'title',
            'subject',
            'cc_roles',
            'message',
            'signer_roles',
        );

        if(isset($this->merge_fields)){
            $merge_fields = json_encode($this->merge_fields);
        }

        $params = $this->toArray();
        $params['merge_fields'] = $merge_fields;

        foreach ($params as $key => $value) {
            if(!in_array($key, $fields_to_include)){
                unset($params[$key]);
            }
        }

        return $params;
    }
}