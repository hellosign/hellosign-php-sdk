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
 * Represents a HelloSign BulkSendJob to send SignatureRequests based on a Template
 *
 */
class BulkSendJob extends AbstractSignatureRequest
{
    /**
     * The list of Templates used when creating the SignatureRequest
     * @var array
     */
    protected $template_ids = array();

    /**
     * The CSV file definining values and options for signer fields.
     * Required unless signer_list is defined, but not both.
     * @var array
     */
    protected $signer_file = array();

    /**
     * A JSON array defining values and options for the signer fields.
     * Required unless signer_file is defined, but not both.
     * @var string
     */
    protected $signer_list = null;

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
            'use_preexisting_fields',
            'requesting_redirect_url',
            'signers',
            'requester_email_address',
            'signing_options'
        );
        return $this->toArray(array(
            'except' => $except
        ));
    }
}
