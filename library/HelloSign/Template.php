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
     * The id of the Template
     *
     * @var string
     */
    protected $template_id;

    /**
     * Client ID of the API App used to create this draft.
     *
     * @var string
     */
    protected $client_id;

    /**
     * The title of the Template
     *
     * This will also be the default subject of the message sent to signers
     * when using this Template to send a SignatureRequest. This can be
     * overriden when sending the SignatureRequest.
     *
     * @var string
     */
    protected $title;

    /**
     * The default message that will be sent to signers when using this
     * Template to send a SignatureRequest. This can be overriden when
     * sending the SignatureRequest.
     *
     * @var string
     */
    protected $message;

    /**
     * Specifies if the current account is the creator of the Template.
     *
     * @var boolean
     */
    protected $is_creator = false;

    /**
     * Specifies if the current account can edit the Template.
     *
     * @var boolean
     */
    protected $can_edit = false;

    /**
     * Used when creating embedded draft requests - Edit URL returned from server.
     *
     * @var string
     */
    protected $edit_url = null;

    /**
     * Used when creating embedded draft requests - Expiration timestamp for the $edit_url.
     *
     * @var integer
     */
    protected $expires_at = null;

    /**
     * An array of the designated signer roles that must be specified when
     * sending a SignatureRequest using this Template.
     *
     * @var array
     */
    protected $signer_roles = array();

    /**
     * An array of signer attachements
     *
     * @var AttachmentList
     */
    protected $attachments = null;

    /**
     * Specifies whether or not to prompt the user to edit signer roles.
     *
     * @var boolean
     */
    protected $skip_signer_roles = false;

    /**
     * An array of the designated CC roles that must be specified when sending
     * a SignatureRequest using this Template.
     *
     * @var array
     */
    protected $cc_roles = array();

    /**
     * An array describing each document associated with this Template.
     * Includes signer components for each document.
     *
     * @var array
     */
    protected $documents = array();

    /**
     * A JSON array of custom_field objects on the Template.
     *
     * @var string
     */
    protected $custom_fields = null;

    /**
     * A JSON array of form_fields objects on the Template.
     *
     * @var string
     */
    protected $form_fields = null;

    /**
     * An array of Merge Field objects containing the name and type of each
     * merge field. Used when creating embedded drafts.
     *
     * @var array
     */
    protected $merge_fields = array();

    /**
     * An array of the Accounts that can use this Template.
     *
     * @var array
     */
    protected $accounts = array();

    /**
     * Specifies whether or not the user is prompted to edit the subject and
     * message, if they have already been provided.
     *
     * @var boolean
     */
    protected $skip_subject_message = false;

    /**
     * Disables the "Me (Now)" option for the person preparing the Template.
     *
     * @var boolean
     */
    protected $skip_me_now = false;

    /**
     * Used when creating an embedded template draft.
     * Specifies if this Template should use preexisting fields from the original document.
     *
     * @var boolean
     */
    protected $use_preexisting_fields = false;

    /**
    * Whether the signers can reassign the SignatureRequest created using this Template
    *
    * Defaults to false.
    *
    * @var boolean
    */
   protected $allow_reassign = false;

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
    public function getFormFields()
    {
        return $this->form_fields;
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
     * @param string $id Client ID of the API App
     * @return boolean
     * @ignore
     */
    public function setClientId($id)
    {
        $this->client_id = $id;
        return true;
    }

    /**
     * @param string $role Role Name for the signer.
     * @param integer $order Order of the signer. (optional)
     * @return boolean
     * @ignore
     */
    public function addSignerRole($role, $order = null)
    {
        $signer_role = array(
            'name' => $role
        );

        if ($order != null) {
            $signer_role['order'] = $order;
        }

        $this->signer_roles[] = $signer_role;
        return true;
    }

    /**
     * @param string $role Role Name for CC recipients.
     * @return boolean
     * @ignore
     */
    public function addCCRole($role)
    {
        $this->cc_roles[] = $role;
        return true;
    }

    /**
     * @param string $name Name of the merge field. Names must be unique.
     * @param string $type Type of the merge field. Type can only be "text" or "checkbox."
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
     * Adds an Attachment to the EmbeddedTemplate
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
     * @return Template
     * @ignore
     */
    public function enableAllowReassign()
    {
        $this->allow_reassign = true;
        return $this;
    }

    /**
     * @return Template
     * @ignore
     */
    public function disableAllowReassign()
    {
        $this->allow_reassign = false;
        return $this;
    }

    /**
     * @return Template
     * @ignore
     */
    public function enableSkipSignerRoles()
    {
        $this->skip_signer_roles = true;
        return $this;
    }

    /**
     * @return Template
     * @ignore
     */
    public function enableSkipSubjectMessage()
    {
        $this->skip_subject_message = true;
        return $this;
    }

    /**
       * @param  boolean $use_preexisting_fields Set to true to use preexisting fields.
       * @return Template
       * @ignore
       */
    public function setUsePreexistingFields($use_preexisting_fields)
    {
        $this->use_preexisting_fields = $use_preexisting_fields;
        return $this;
    }

    /**
       * @param  boolean $skip_me_now Set to true to disable the "Me (Now)" option
       * for the preparer.
       * @return Template
       * @ignore
       */
    public function enableSkipMeNow()
    {
        $this->skip_me_now = true;
        return $this;
    }


    /**
     * @param  stdClass $array
     * @param  array $options
     * @return Template
     * @ignore
     */
    public function fromArray($array, $options = array())
    {
        if (!isset($options['except'])) {
          $options['except'] = array();
        }

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
            'use_preexisting_fields',
            'metadata',
            'skip_me_now',
            'allow_reassign',
            'attachments'
        );

        if (isset($this->merge_fields) && count($this->merge_fields) > 0) {
            $merge_fields = json_encode($this->merge_fields);
        }
        $params = $this->toArray();

        foreach ($params as $key => $value) {
            if (!in_array($key, $fields_to_include)) {
                unset($params[$key]);
            }
        }

        if (isset($merge_fields)) {
            $params['merge_fields'] = $merge_fields;
        }

        return $params;
    }

    public function toParams()
    {
        $fields_to_include = array(
            'template_id',
            'test_mode',
            'client_id',
            'file',
            'file_url',
            'subject',
            'message',
            'skip_signer_roles',
            'skip_subject_message'
        );

        $params = $this->toArray();

        foreach ($params as $key => $value) {
            if (!in_array($key, $fields_to_include)) {
                unset($params[$key]);
            }
        }

        return $params;
    }

    public function toUpdateParams()
    {
        $fields_to_include = array(
            'template_id',
            'file',
            'file_url',
            'subject',
            'message',
            'client_id',
            'test_mode'
        );

        $params = $this->toArray();

        foreach ($params as $key => $value) {
            if (!in_array($key, $fields_to_include)) {
                unset($params[$key]);
            }
        }

        return $params;
    }
}
