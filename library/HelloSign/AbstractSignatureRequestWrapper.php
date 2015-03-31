<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * EmbeddedSignatureRequest and UnclaimedDraft will have common fields & methods
 * such as client_id, request, isUsingTemplate(). This class centralizes those fields & methods.
 */
abstract class AbstractSignatureRequestWrapper extends AbstractResource
{
    /**
     * Client id of the app
     *
     * @var string
     */
    protected $client_id = null;

    /**
     * Related signature request
     *
     * @var AbstractSignatureRequest
     */
    protected $request = null;

    /**
     * Flag that enables embedded signing for the request
     *
     * @var bool
     */
    protected $is_for_embedded_signing = false;

    /**
     * Constructor
     *
     * @param AbstractSignatureRequest $request
     * @param string $client_id
     */
    public function __construct(AbstractSignatureRequest $request = null, $client_id = null)
    {
        $this->request = $request;
        $this->setClientId($client_id);
    }

    /**
     * @param  string $id
     * @return static
     * @ignore
     */
    public function setClientId($id)
    {
        $this->client_id = $id;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @return static
     * @ignore
     */
    public function setEmbeddedSigning()
    {
        $this->is_for_embedded_signing = true;
        return $this;
    }

    /**
     * @param AbstractSignatureRequest $request
     * @return static
     * @ignore
     */
    public function setRequest(AbstractSignatureRequest $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return AbstractSignatureRequest
     * @ignore
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function isUsingTemplate()
    {
        return $this->request instanceof TemplateSignatureRequest;
    }

    /**
     * @return array
     * @ignore
     */
    public function toParams()
    {
        return $this->toArray(array(
            'except' => array(
                'request'
            )
        )) + $this->request->toParams(array(
            'except' => array(
                'title'
            )
        ));
    }
}