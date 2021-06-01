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
 * This is a utility class for assisting with the development of callback
 * services to respond to HelloSign events
 */
class Event extends AbstractResource
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'event';

    /**
     * The id of the Account
     *
     * signature_request_viewed: The SignatureRequest has been viewed
     * signature_request_signed: A signer has completed all required fields on
     * the SignatureRequest
     * signature_request_sent: The SignatureRequest has been sent successfully
     * signature_request_all_signed: All signers have completed all required
     * fields for the SignatureRequest and the final PDF is ready to be
     * downloaded
     * file_error: We're unable to convert the file you provided
     *
     * @var string
     * @see Client::getFiles()
     */
    protected $event_type = null;

    /**
     * When the event was created (UNIX timestamp)
     *
     * @var string
     */
    protected $event_time = null;

    /**
     * Unique hash of this event
     *
     * @var string
     * @see hash verification
     */
    protected $event_hash = null;

    /**
     * A map of values containing data related to this event
     *
     * related_signature_id: Signature associated with this event. Only set when
     * event_type is signature_request_signed
     * reported_for_account_id: Id of the account this event is reported for
     * reported_for_app_id: Client id of the app this event is reported for
     * @var stdClass
     */
    protected $event_metadata = null;

    /**
     * Related signature request, only present when the event is
     * signature-related
     *
     * @var SignatureRequest
     */
    protected $signature_request = null;

    /**
     * Constructor
     *
     * @param  stdClass $response
     * @param  array $options
     * @ignore
     */
    public function __construct($response = null, $options = array())
    {
        $this->event_metadata = new stdClass;

        parent::__construct($response, $options);
    }

    /**
     * @return string
     * @ignore
     */
    public function getTime()
    {
        return $this->event_time;
    }

    /**
     * @return string
     * @ignore
     */
    public function getType()
    {
        return $this->event_type;
    }

    /**
     * @return string
     * @ignore
     */
    public function getAccountId()
    {
        return $this->event_metadata->reported_for_account_id;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasAccountId()
    {
        return isset($this->event_metadata->reported_for_account_id);
    }

    /**
     * @return string
     * @ignore
     */
    public function getRelatedSignatureId()
    {
        return $this->event_metadata->related_signature_id;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasRelatedSignatureId()
    {
        return isset($this->event_metadata->related_signature_id);
    }

    /**
     * @return Signature
     * @ignore
     */
    public function getRelatedSignature()
    {
        if (!$this->hasRelatedSignatureId()) {
            return null;
        }

        foreach ($this->signature_request->getSignatures() as $signature) {
            if ($signature->getId() == $this->getRelatedSignatureId()) {
                return $signature;
            }
        }

        return null;
    }

    /**
     * @return SignatureRequest
     * @ignore
     */
    public function getSignatureRequest()
    {
        return $this->signature_request;
    }

    /**
     * @param  stdClass $response
     * @param  array $options
     * @return SignatureRequest
     * @ignore
     */
    public function fromResponse($response, $options = array())
    {
        if(isset($response->signature_request)) {
          $this->setSignatureRequest($response->signature_request);
        }

        return parent::fromResponse($response, $options);
    }

    /**
     * Check the event is valid or not
     * @param  string $api_key
     * @return boolean
     * @see Event::calculateHash()
     */
    public function isValid($api_key)
    {
        if (!$api_key) {
            return false;
        }

        return ($this->event_hash == $this->calculateHash($api_key))
            ? true : false;
    }

    /**
     * @return string
     * @ignore
     */
    protected function calculateHash($api_key)
    {
        return hash_hmac("sha256", $this->event_time . $this->event_type, $api_key);
    }

    /**
     * @param  stdClass $signature_request
     * @return Event
     * @ignore
     */
    protected function setSignatureRequest($signature_request)
    {
        $this->signature_request = new SignatureRequest;
        $this->signature_request->fromObject($signature_request);

        return $this;
    }
}
