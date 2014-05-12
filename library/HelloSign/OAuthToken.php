<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
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
