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
 * Model object that represents a HelloSign OAuth Token request
 */
class OAuthTokenRequest extends AbstractObject
{
    /**
     * The Client ID of your API App
     *
     * @var string
     */
    protected $client_id = null;

    /**
     * The secret token of your API App
     *
     * @var string
     */
    protected $client_secret = null;

    /**
     * The "state" parameter is use for security and must match throughout the
     * flow for a given user. It can be set to the value of your choice
     * (preferably something random). You should verify it matches the expected
     * value when getting an OAuth callback.
     *
     * @var string
     */
    protected $state = null;

    /**
     * The code passed to your callback when the user granted access
     *
     * @var string
     */
    protected $code = null;

    /**
     * @param  string $state
     * @return OAuthTokenRequest
     * @ignore
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param  string $code
     * @return OAuthTokenRequest
     * @ignore
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param  string $client_id
     * @return OAuthTokenRequest
     * @ignore
     */
    public function setClientID($client_id)
    {
        $this->client_id = $client_id;
        return $this;
    }

    /**
     * @param  string $client_secret
     * @return OAuthTokenRequest
     * @ignore
     */
    public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;
        return $this;
    }

    /**
     * @return array
     * @ignore
     */
    public function toParams()
    {
        return $this->toArray() + array(
            'grant_type' => 'authorization_code'
        );
    }
}
