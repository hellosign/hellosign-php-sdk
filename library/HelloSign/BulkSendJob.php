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
 */
class BulkSendJob extends AbstractSignatureRequest
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'bulk_send_job';

    /**
     * The ID of the BulkSendJob
     *
     * @var string
     */
    protected $bulk_send_job_id = null;

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
     * An array of SignatureRequest objects
     *
     * @var SignatureRequestList
     */
    protected $signature_requests = null;

    /**
     * An array with information about the Signature Requests
     * sent as part of the Bulk Send Job
     *
     * @var array
     */
    protected $list_info = array();

    /**
     * Set the template ID, along with an optional order
     * @param string $id
     * @param int null $index
     * @return \HelloSign\BulkSendJob
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
     * Adds a list of signers in a CSV file. Required unless signer_list is used.
     *
     * @param  string $file path for signer_file
     * @return BulkSendJob
     * @ignore
     */
    public function addSignerfile($file)
    {
        if (!file_exists($file)) {
            throw new Error('file not found', 'File does not exist. Please use an absolute file path.');
        }

        $this->signer_file = fopen($file, 'rb');
        return $this;
    }

    /**
     * Adds a list of signers defined in a JSON array. Required unless signer_file is used.
     *
     * @param  array $signer_list
     * @return BulkSendJob
     * @ignore
     */
     public function addSignerList($signer_list)
     {
         $this->signer_list = json_encode($signer_list);
         return $this;
     }

    /**
    * Sets the CC email address for the provided role
    *
    * @param  string $role
    * @param  string $email
    * @return BulkSendJob
    */
    public function setCC($role, $email)
    {
        $obj = new stdClass;
        $obj->email_address = $email;

        $this->ccs[$role] = $obj;

        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getId()
    {
        return $this->bulk_send_job_id;
    }

    /**
     * @return SignatureRequestList
     * @ignore
     */
    public function getSignatureRequests()
    {
        return $this->signature_requests;
    }

    /**
     * Constructor
     *
     * @param  stdClass $response
     * @param  array $options
     * @ignore
     */
    public function __construct($response = null, $options = array())
    {
        if (isset($response->signature_requests))
        {
          $this->signature_requests = $response->signature_requests;
        }

        if (isset($response->list_info))
        {
          $this->list_info = $response->list_info;
        }

        parent::__construct($response, $options);
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
            'signing_options',
            'allow_decline'
        );
        return $this->toArray(array(
            'except' => $except
        ));
    }
}
