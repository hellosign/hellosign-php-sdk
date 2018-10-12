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
 * Stores HelloSign Account information
 */
class Account extends AbstractResource
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'account';

    /**
     * The id of the Account
     *
     * @var string
     */
    protected $account_id = null;

    /**
     * The email address associated with the Account
     *
     * @var string
     */
    protected $email_address = null;

    /**
     * The URL that HelloSign Account events will be POSTed to
     *
     * @var string
     */
    protected $callback_url = null;

    /**
     * If the user has a paid HelloSign subscription, will return true
     *
     * @var boolean
     */
    protected $is_paid_hs = false;

    /**
     * If the user has a paid HelloFax subscription, will return true
     *
     * @var boolean
     */
    protected $is_paid_hf = false;

    /**
     * An object detailing remaining quotas
     *
     * templates_left: API templates remaining
     * api_signature_requests_left: API signature requests remaining for the month
     *
     * @var stdClass
     */
    protected $quotas = null;

    /**
     * The membership role for the team. a = Admin, m = Member
     *
     * @var string
     */
    protected $role_code = null;

    /**
     * The password for the new Account
     *
     * @var string
     * @deprecated This field will be ignored
     */
    protected $password = null;

    /**
     * Authorization data
     *
     * @var OAuthToken
     */
    protected $oauth_data = null;

    /**
     * Constructor
     *
     * @param mixed $email_or_obj
     * @param string $password DEPRECATED; This will be ignored if specified
     */
    public function __construct($email_or_obj = null, $password = null)
    {
        if (is_string($email_or_obj)) {
            $this->email_address = $email_or_obj;
        } else {
            parent::__construct($email_or_obj);
        }
    }

    /**
     * @return string
     * @ignore
     */
    public function getId()
    {
        return $this->account_id;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasId()
    {
        return isset($this->account_id);
    }

    /**
     * @return string
     * @ignore
     */
    public function getEmail()
    {
        return $this->email_address;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasEmail()
    {
        return isset($this->email_address);
    }

    /**
     * @return boolean
     * @ignore
     */
    public function isPaidHS()
    {
        return $this->is_paid_hs;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function isPaidHF()
    {
        return $this->is_paid_hf;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getTemplatesLeft()
    {
        return $this->quotas->templates_left;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getApiSigReqsLeft()
    {
        return $this->quotas->api_signature_requests_left;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getDocumentsLeft()
    {
        return $this->quotas->documents_left;
    }

    /**
     * @return string
     * @ignore
     */
    public function getCallbackUrl()
    {
        return $this->callback_url;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasCallbackUrl()
    {
        return isset($this->callback_url);
    }

    /**
     * @param  string $url
     * @return Account
     * @ignore
     */
    public function setCallbackUrl($url)
    {
        $this->callback_url = $url;
        return $this;
    }

    /**
     * @return string
     * @ignore
     */
    public function getRoleCode()
    {
        return $this->role_code;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasRoleCode()
    {
        return isset($this->role_code);
    }

    /**
     * @return boolean
     * @ignore
     */
    public function isTeamAdmin()
    {
        return ($this->role_code == 'a');
    }

    /**
     * @param  string $email
     * @return Account
     * @ignore
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param  string $password
     * @return Account
     * @ignore
     * @deprecated This field will be ignored
     */
    public function setPassword($password)
    {
        return $this;
    }

    /**
     * @return OAuthToken
     * @ignore
     */
    public function getOAuthData()
    {
        return $this->oauth_data;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasOAuthData()
    {
        return isset($this->oauth_data);
    }

    /**
     * @param  stdClass $response
     * @param  array $options
     * @return Account
     * @ignore
     */
    public function fromResponse($response, $options = array())
    {
        isset($response->oauth_data) && $this->setOAuthData($response->oauth_data);

        return parent::fromResponse($response, $options);
    }

    /**
     * @return array
     * @ignore
     */
    public function toCreateParams()
    {
        return $this->toArray(array(
            'only' => array(
                'email_address'
            )
        ));
    }

    /**
     * @return array
     * @ignore
     */
    public function toUpdateParams()
    {
        return $this->toArray(array(
            'only' => array(
                'callback_url'
            )
        ));
    }

    /**
     * @param  stdClass $oauth_data
     * @return Account
     * @ignore
     */
    protected function setOAuthData($oauth_data)
    {
        $this->oauth_data = new OAuthToken($oauth_data);

        return $this;
    }
}
