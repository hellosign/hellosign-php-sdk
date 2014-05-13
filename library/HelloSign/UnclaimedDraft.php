<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Represents an unclaimed draft response and request
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
     * The type of unclaimed draft to create
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
     * @param  string $id
     * @return UnclaimedDraft
     * @ignore
     */
    public function setIsForEmbeddedSigning($is_for_embedded_signing)
    {
        $this->is_for_embedded_signing = $is_for_embedded_signing;
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
            // 'is_for_embedded_signing',
            'claim_url'
        );

        if (!$this->isForEmbeddedSigning()) {
            $except[] = 'is_for_embedded_signing';
        }
        
        if(!$this->getClientId()) {
        	$except[] = 'client_id';
        }

        return $this->toArray(array(
            'except' => $except
        )) + $this->request->toParams(array(
            'except' => array(
                'title',
        		'use_text_tags',
        		'hide_text_tags'
            )
        ));
    }
}