<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Class to hold an embedded signature request response
 */
class EmbeddedResponse extends AbstractResource
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'embedded';

    /**
     * URL of the signature page to display in the embedded iFrame
     *
     * @var string
     */
    protected $sign_url = null;

    /**
     * When the link expires
     *
     * @var integer
     */
    protected $expires_at = null;

    /**
     * @return string
     * @ignore
     */
    public function getSignUrl()
    {
        return $this->sign_url;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }
}