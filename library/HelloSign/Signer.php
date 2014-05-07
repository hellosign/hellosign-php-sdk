<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Class that stores signer information for a signature request
 */
class Signer extends AbstractObject
{
    /**
     * The name of the signer
     *
     * @var string
     */
    protected $name = null;

    /**
     * The email address of the signer
     *
     * @var string
     */
    protected $email_address = null;

    /**
     * The order the signer is required to sign in
     *
     * @var integer
     */
    protected $order = null;

    /**
     * The access code that will secure this signer's signature page. You must
     * have a business plan to use this feature. Can be up to 12 alphanumeric characters
     *
     * @var string
     */
    protected $pin = null;

    /**
     * @param  array $options
     * @return array
     * @see    AbstractObject::toArray()
     * @ignore
     */
    public function toArray($options = array())
    {
        !isset($options['include_null']) && $options['include_null'] = false;

        return parent::toArray($options);
    }
}