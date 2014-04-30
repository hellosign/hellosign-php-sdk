<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Represents a paged list of SignatureRequests returned from HelloSign
 */
class SignatureRequestList extends AbstractResourceList
{
    /**
     * @var string
     * @ignore
     */
    protected $list_type = 'signature_requests';

    /**
     * @var string
     * @ignore
     */
    protected $resource_class = 'SignatureRequest';
}