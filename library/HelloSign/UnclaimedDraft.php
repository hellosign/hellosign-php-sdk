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
 * Represents an UnclaimedDraft response and request
 *
 * The UnclaimedDraft object essentially "wraps" a SignatureRequest. There are
 * two types of unclaimed drafts that can be created:
 *
 * "send_document" - simply creates a claimable file
 * "request_signature" - creates a claimable signature request. If this type is
 * chosen, the signers name(s) and email address(es) are not optional.
 */
class UnclaimedDraft extends AbstractSignatureRequestWrapper
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'unclaimed_draft';

    /**
     * The type of UnclaimedDraft to create
     *
     * Use "send_document" to create a claimable file, and "request_signature"
     * for a claimable signature request. If the type is "request_signature"
     * then signers name and email_address are not optional.
     *
     * @var string
     */
    protected $type = 'send_document';

    /**
     * Whether this Unclaimed Draft is to be embedded or not
     *
     * @var boolean
     */
    protected $is_for_embedded_signing = false;

    /**
     * The claim URL, present if the draft has been created
     *
     * @var string
     */
    protected $claim_url = null;

    /**
     * Whether this unclaimed draft should use preexisting fields from the original document
     *
     * @var boolean
     */
    protected $use_preexisting_fields = false;

    /**
     * Disables the "Me (Now)" option for the person preparing the SignatureRequest.
     *
     * @var boolean
     */
    protected $skip_me_now = false;

    /**
     * @param  boolean $is_for_embedded_signing
     * @return UnclaimedDraft
     * @ignore
     */
    public function setIsForEmbeddedSigning($is_for_embedded_signing)
    {
        $this->is_for_embedded_signing = $is_for_embedded_signing;
    }

    /**
       * @param  boolean $use_preexisting_fields
       * @return UnclaimedDraft
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
       * @return UnclaimedDraft
       * @ignore
       */
    public function enableSkipMeNow()
    {
        $this->skip_me_now = true;
        return $this;
    }

    /**
     * @param  string $id
     * @return UnclaimedDraft
     * @ignore
     */
    public function setClientId($id)
    {
        if ($id) {
            $this->type = 'request_signature';
        }

        return parent::setClientId($id);
    }

    /**
     * @param string $type
     * @return UnclaimedDraft
     * @ignore
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns true if this Unclaimed Draft is to be embedded
     *
     * @return boolean true if this Unclaimed Draft is to be embedded
     */
    public function isForEmbeddedSigning()
    {
        return $this->is_for_embedded_signing;
    }

    /**
     * @return string claim URL
     * @ignore
     */
    public function getClaimUrl()
    {
        return $this->claim_url;
    }

    /**
     * @return array
     * @ignore
     */
    public function toParams()
    {
        $except = array(
            'request',
            'claim_url'
        );

        // Skip including files local to this object if specified on the request instead
        if (isset($this->request) && !sizeof($this->file)) {
            array_push($except, 'file');
        }

        if (!$this->isForEmbeddedSigning()) {
            $except[] = 'is_for_embedded_signing';
        }

        if (!$this->getClientId()) {
            $except[] = 'client_id';
        }

        /**
         * Here we union (using the + operator) the param arrays for the
         * SignatureRequest object with our self (the UnclaimedDraft
         * object) to get the final params array. The order of this union is
         * important! The params from $this->request must be left of the union
         * operator so that its values (e.g. test_mode) take precedence over
         * our defaults.
         */
        return $this->request->toParams(array(
            'except' => array(
                'title' // title not supported for unclaimed draft endpoints
            )
        )) + $this->toArray(array(
            'except' => $except
        ));
    }

    public function toEditParams()
    {
        $fields_to_include = array(
            'client_id',
            'test_mode',
            'requesting_redirect_url',
            'signing_redirect_url',
            'is_for_embedded_signing',
            'requester_email_address'
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
