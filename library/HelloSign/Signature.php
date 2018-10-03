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
 * Model object that stores information related to a signature captured on a HelloSign
 * SignatureRequest
 */
class Signature extends AbstractObject
{
    /**
     * Signature identifier
     *
     * @var string
     */
    protected $signature_id = null;

    /**
     * The email address of the signer
     *
     * @var string
     */
    protected $signer_email_address = null;

    /**
     * The name of the signer
     *
     * @var string
     */
    protected $signer_name = null;

    /**
     * If signer order is assigned this is the 0-based index for this signer
     *
     * @var integer
     */
    protected $order = null;

    /**
     * The current status of the signature
     *
     * eg: awaiting_signature, signed, on_hold
     *
     * @var string
     */
    protected $status_code = null;

    /**
     * Time that the document was signed or null
     *
     * @var integer
     */
    protected $signed_at = null;

    /**
     * The time that the document was last viewed by this signer or null
     *
     * @var integer
     */
    protected $last_viewed_at = null;

    /**
     * The time the last reminder email was sent to the signer or null
     *
     * @var integer
     */
    protected $last_reminded_at = null;

    /**
     * Boolean to indicate whether this signature requires a PIN to access
     *
     * @var boolean
     */
    protected $has_pin = null;

    /**
     * @return string
     * @ignore
     */
    public function getId()
    {
        return $this->signature_id;
    }

    /**
     * @return string
     * @ignore
     */
    public function getSignerEmail()
    {
        return $this->signer_email_address;
    }

    /**
     * @return string
     * @ignore
     */
    public function getSignerName()
    {
        return $this->signer_name;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     * @ignore
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getSignedAt()
    {
        return $this->signed_at;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getLastViewedAt()
    {
        return $this->last_viewed_at;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getLastRemindedAt()
    {
        return $this->last_reminded_at;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasPin()
    {
        return $this->has_pin;
    }
}
