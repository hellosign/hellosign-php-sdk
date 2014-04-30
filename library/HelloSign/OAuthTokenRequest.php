<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Model object that represents a HelloSign OAuth Token request
 */
class OAuthTokenRequest extends AbstractObject
{
    /**
     * The client id of your app
     *
     * @var string
     */
    protected $client_id = null;

    /**
     * The secret token of your app
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