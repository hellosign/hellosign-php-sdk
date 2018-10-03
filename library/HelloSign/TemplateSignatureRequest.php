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

use stdClass;

/**
 * Represents a HelloSign SignatureRequest based on a Template
 *
 * Unlike the SignatureRequest, this object is only used to submit
 * the request. A successfully submitted TemplateSignatureRequest will
 * return a SignatureRequest object from the server.
 */
class TemplateSignatureRequest extends AbstractSignatureRequest
{
    /**
     * The list of Templates used when creating the SignatureRequest
     * @var array
     */
    protected $template_ids = array();

    /**
     * A list of email addresses that were CCed on the TemplateSignatureRequest
     *
     * They will receive a copy of the final PDF once all the signers have
     * signed.
     *
     * @var array
     */
    protected $ccs = array();

    /**
     * Set the template ID, along with an optional order
     * @param string $id
     * @param int null $index
     * @return \HelloSign\TemplateSignatureRequest
     */
    public function setTemplateId($id, $order = null) {
        if ($order === null) {
            // If no order is provided, append the template ID to the end of the list
            $this->template_ids[] = $id;
        } else {
            $this->template_ids[$order] = $id;
        }
        return $this;
    }

    /**
     * Set the signer to the list of signers for this request
     *
     * @param  string $role
     * @param  mixed $email_or_signer
     * @param  string $name
     * @return TemplateSignatureRequest
     * @see    AbstractSignatureRequest::addSigner()
     */
    public function setSigner($role, $email_or_signer, $name = null)
    {
        return parent::addSigner($email_or_signer, $name, $role);
    }

    /**
    * Sets the CC email address for the provided role
    *
    * @param  string $role
    * @param  string $email
    * @return TemplateSignatureRequest
    */
    public function setCC($role, $email)
    {
        $obj = new stdClass;
        $obj->email_address = $email;

        $this->ccs[$role] = $obj;

        return $this;
    }

    /**
     * @return array
     * @ignore
     */
    public function toParams()
    {
        $except = array(
            'use_text_tags',
            'hide_text_tags',
            'use_preexisting_fields'
        );
        return $this->toArray(array(
            'except' => $except
        ));
    }
}
