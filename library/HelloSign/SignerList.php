<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Represents an array of Signer
 */
class SignerList extends AbstractList
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_class = 'Signer';
}