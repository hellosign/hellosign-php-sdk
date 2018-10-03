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
 * Model object that represents a HelloSign OAuth Token resource
 */
class OAuthToken extends AbstractObject
{
    /**
     * Access token
     *
     * @var string
     */
    protected $access_token = null;

    /**
     * String value of "Bearer"
     *
     * @var string
     */
    protected $token_type = 'Bearer';

    /**
     * Expire time in seconds
     *
     * @var integer
     */
    protected $expires_in = null;

    /**
     * Token used to refresh access_token
     *
     * @var string
     */
    protected $refresh_token = null;

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
     * @return string
     * @ignore
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @return string
     * @ignore
     */
    public function getTokenType()
    {
        return $this->token_type;
    }

    /**
     * @return integer
     * @ignore
     */
    public function getExpiresIn()
    {
        return $this->expires_in;
    }

    /**
     * @return array
     * @ignore
     */
    public function toParams()
    {
        return $this->toArray(array(
            'except' => array(
                'state'
            )
        )) + array(
            'grant_type' => 'refresh_token'
        );
    }
}
