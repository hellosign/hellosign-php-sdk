<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
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
class ApiApp extends AbstractResource
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'api_app';

    /**
     * The client ID of the API App
     *
     * @var string
     */
    protected $client_id = null;

    /**
     * The domain of the API App
     *
     * @var string
     */
    protected $domain = null;

    /**
     * The URL that HelloSign events will be POSTed to
     *
     * @var string
     */
    protected $callback_url = null;

    /**
     * The custom branding logo for the API App
     *
     * @var string
     */
    protected $custom_logo_file = null;

    /**
     * The name of the API App
     *
     * @var string
     */
    protected $name = null;

    /**
     * If the API App is approved will return true
     *
     * @var boolean
     */
    protected $is_approved = false;

    /**
     * An object detailing API App owner
     *
     * account_id: Account ID of owner
     * email_address: Email address of owner
     *
     * @var stdClass
     */
    protected $owner_account = null;

    /**
     * An object with API App options
     *
     * @var stdClass
     */
    protected $options = null;

    /**
     * Oauth details
     *
     * @var string
     */
    protected $oauth = null;

    /**
     * A JSON array of Custom Field objects
     *
     * @var string
     */
    protected $white_labeling_options = null;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $domain
     * @param string $callback_url
     * @param string $custom_logo_file
     * @param string $white_labeling_options
     */
    public function __construct($name = null, $domain = null, $callback_url = null, $custom_logo_file = null, $white_labeling_options = null)
    {
        if (is_string($name)) {
            $this->name = $name;
            $this->domain = $domain;
            $this->callback_url = $callback_url;
            $this->custom_logo_file = fopen($custom_logo_file, 'rb');
            $this->white_labeling_options = $white_labeling_options;
        } else {
            parent::__construct($name);
        };

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
     * @return string
     * @ignore
     */
    public function getOwner()
    {
        return $this->owner_account;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function isApproved()
    {
        return $this->is_approved;
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
     * @return OAuthToken
     * @ignore
     */
    public function getOAuthData()
    {
        return $this->oauth;
    }

    /**
     * @return boolean
     * @ignore
     */
    public function hasOAuthData()
    {
        return isset($this->oauth);
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
              'name',
              'domain',
              'callback_url',
              'custom_logo_file',
              'white_labeling_options'
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
