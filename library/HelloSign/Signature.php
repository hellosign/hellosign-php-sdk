<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
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