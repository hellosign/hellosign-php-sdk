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
 * EmbeddedSignatureRequest and UnclaimedDraft will have common fields & methods
 * such as client_id, request, isUsingTemplate(). This class centralizes those fields & methods.
 */
abstract class AbstractSignatureRequestWrapper extends AbstractResource
{
    /**
     * Client ID of the API App
     *
     * @var string
     */
    protected $client_id = null;

    /**
     * Related SignatureRequest
     *
     * @var AbstractSignatureRequest
     */
    protected $request = null;

    /**
     * Disables the "Me (Now)" option for the person preparing the SignatureRequest.
     *
     * @var boolean
     */
    protected $skip_me_now = false;

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
     * Include only if enabling embedded signing
     * when using EmbeddedSignatureRequest
     * with createUnclaimedDraftEmbeddedWithTemplate
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
       * @param  boolean $skip_me_now Set to true to disable the "Me (Now)" option
       * for the preparer.
       * @return static
       * @ignore
       */
    public function enableSkipMeNow()
    {
        $this->skip_me_now = true;
        return $this;
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
