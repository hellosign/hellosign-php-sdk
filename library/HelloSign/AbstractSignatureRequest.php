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
 * Requests to HelloSign will have common fields such as a request title,
 * subject, and message. This class centralizes those fields.
 */
abstract class AbstractSignatureRequest extends AbstractResource
{
    /**
     * The URL you want the signer redirected to after they successfully sign
     *
     * @var string
     */
    protected $signing_redirect_url = null;

    /**
     * The URL you want the requester redirected to after they successfully send their request
     *
     * @var string
     */
    protected $requesting_redirect_url = null;

    /**
     * An array of signers
     *
     * @var SignerList
     */
    protected $signers = null;

    /**
     * The email address of the initiator of the SignatureRequest
     *
     * @var string
     */
    protected $requester_email_address = null;

    /**
     * Whether this signature request uses text tags
     *
     * Text tags are macros in the document itself that signify form fields. Defaults to false.
     *
     * @var boolean
     */
    protected $use_text_tags = false;

    /**
     * If using text tags, white them out
     *
     * @var boolean
     */
    protected $hide_text_tags = false;

    /**
     * The client ID of the ApiApp you want to associate with this request.
     * @var string
     */
    protected $client_id = null;

    /**
     * A JSON array of Custom Field objects
     *
     * @var string
     */
    protected $custom_fields = null;

    /**
     * This allows the sender to specify the types allowed for creating a signature.
     * Defaults to the allowed types in the sender's account settings.
     *
     * @var array
     */
    protected $signing_options = array();

    /**
     * Constructor
     *
     * @param  stdClass $response
     * @param  array $options
     * @ignore
     */
    public function __construct($response = null, $options = array())
    {
        $this->signers = new SignerList;

        parent::__construct($response, $options);
    }

    /**
     * @param  string $url
     * @return SignatureRequest
     * @ignore
     */
    public function setSigningRedirectUrl($url)
    {
        $this->signing_redirect_url = $url;
        return $this;
    }

    /**
     * @param  string $url
     * @return static
     * @ignore
     */
    public function setRequestingRedirectUrl($url)
    {
        $this->requesting_redirect_url = $url;
        return $this;
    }

    /**
     * Adds a signer to the signature request
     *
     * @param  mixed $email_or_signer
     * @param  string $name
     * @param  string $index
     * @return AbstractSignatureRequest
     */
    public function addSigner($email_or_signer, $name = null, $index = null)
    {
        $signer = ($email_or_signer instanceof Signer)
            ? $email_or_signer
            : new Signer(array(
                'name' => $name,
                'email_address' => $email_or_signer
            ));

        if (isset($index)) {
            $this->signers[$index] = $signer;
        } else {
            $this->signers[] = $signer;
        }

        return $this;
    }

    /**
     * Adds a Signer Group to the Signature Request
     *
     * @param  string $name Signer Group name
     * @param  mixed $group_index_or_role Group Index or Signer Role. Defaults to 0.
     * @return AbstractSignatureRequest
     */
    public function addGroup($name, $group_index_or_role = 0)
    {
      $group = new SignerGroup(array(
        'name' => $name
      ));

      $this->signers[$group_index_or_role] = $group;

      return $this;
    }

    /**
     * Adds Signers to a Signer Group in the Signature Request
     *
     * @param  string $name Name of the Signer
     * @param  string $email Email address of the Signer
     * @param  integer $signer_index Signer Index of the Signer
     * @param  mixed $group_index_or_role Group Index or Signer Role. Defaults to 0.
     * @return AbstractSignatureRequest
     */
    public function addGroupSigner($name, $email, $signer_index, $group_index_or_role = 0)
    {
      $signer = new Signer(array(
          'name' => $name,
          'email_address' => $email
        )
      );

      $this->signers[$group_index_or_role]->$signer_index = $signer;

      return $this;
    }

    /**
     * @param  array $array
     * @param  array $options
     * @return AbstractSignatureRequest
     * @ignore
     */
    public function fromArray($array, $options = array())
    {
        array_key_exists('signers', $array) && $this->setSigners($array['signers']);

        if (!isset($options['except'])) {
          $options['except'] = array();
        }

        $options['except'][] = 'signers';

        return parent::fromArray($array, $options);
    }

    /**
     * @param  array $signers
     * @return AbstractSignatureRequest
     * @ignore
     */
    protected function setSigners($signers)
    {
        $this->signers->setCollection($signers);

        return $this;
    }

    /**
     * @param  string $email
     * @return SignatureRequest
     * @ignore
     */
    public function setRequesterEmailAddress($email)
    {
        $this->requester_email_address = $email;
        return $this;
    }

    /**
     * Alias to setRequesterEmailAddress
     * @ignore
     */
    public function setRequesterEmail($email)
    {
        return $this->setRequesterEmailAddress($email);
    }

    /**
     * Enable or disable text tags
     * @param boolean $use_text_tags
     */
    public function setUseTextTags($use_text_tags)
    {
        $this->use_text_tags = $use_text_tags;
        return $this;
    }

    /**
     * Enable or disable hiding text tags
     * @param boolean $use_text_tags
     */
    public function setHideTextTags($hide_text_tags)
    {
        $this->hide_text_tags = $hide_text_tags;
        return $this;
    }

    /**
     * @param  array $options
     * @return SignatureRequest
     * @ignore
     */
    public function setSignerOptions($options)
    {
        $this->signing_options = json_encode($options);
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
     * @return AbstractSignatureRequest
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
     * @param  string $id
     * @return SignatureRequest
     * @ignore
     */
    public function setClientId($id)
    {
        $this->client_id = $id;
        return $this;
    }

}
