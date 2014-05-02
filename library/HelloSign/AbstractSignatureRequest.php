<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Requests to HelloSign will have common fields such as a request title,
 * subject, and message. This class centralizes those fields.
 */
abstract class AbstractSignatureRequest extends AbstractResource
{
    /**
     * Whether this is a test signature request
     *
     * Test requests have no legal value. Defaults to false.
     *
     * @var boolean
     */
    protected $test_mode = false;

    /**
     * The title the specified Account uses for the SignatureRequest
     *
     * @var string
     */
    protected $title = null;

    /**
     * The subject in the email that was initially sent to the signers
     *
     * @var string
     */
    protected $subject = null;

    /**
     * The custom message in the email that was initially sent to the signers
     *
     * @var string
     */
    protected $message = null;

    /**
     * The URL you want the signer redirected to after they successfully sign
     *
     * @var string
     */
    protected $signing_redirect_url = null;

    /**
     * An array of signers
     *
     * @var SignerList
     */
    protected $signers = null;
    
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
     * @return SignatureRequest
     * @ignore
     */
    public function enableTestMode()
    {
        $this->test_mode = true;
        return $this;
    }

    /**
     * @return SignatureRequest
     * @ignore
     */
    public function disableTestMode()
    {
        $this->test_mode = false;
        return $this;
    }

    /**
     * @param  string $title
     * @return SignatureRequest
     * @ignore
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param  string $subject
     * @return SignatureRequest
     * @ignore
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param  string $message
     * @return SignatureRequest
     * @ignore
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getMessage()
    {
        return $this->message;
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
     * @param  array $array
     * @param  array $options
     * @return AbstractSignatureRequest
     * @ignore
     */
    public function fromArray($array, $options = array())
    {
        array_key_exists('signers', $array) && $this->setSigners($array['signers']);

        !isset($options['except']) && $options['except'] = array();
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
     * 
     * Enable or disable text tags
     * @param boolean $use_text_tags
     */
    public function setUseTextTags($use_text_tags) 
    {
    	$this->use_text_tags = $use_text_tags;
    	return $this;	
    }
    
	/**
     * 
     * Enable or disable hiding text tags
     * @param boolean $use_text_tags
     */
    public function setHideTextTags($hide_text_tags) 
    {
    	$this->hide_text_tags = $hide_text_tags;
    	return $this;	
    }
}