<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Contains information about team and its members
 */
class Team extends AbstractResource
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'team';

    /**
     * The name of your Team
     *
     * @var string
     */
    protected $name = null;

    /**
     * A list of all Accounts belonging to this team
     *
     * @var array
     */
    protected $accounts = array();

    /**
     * A list of all Accounts belonging to this team
     *
     * @var array
     */
    protected $invited_accounts = array();

    /**
     * Constructor
     *
     * @param mixed $name_or_obj
     */
    public function __construct($name_or_obj = null)
    {
        if (is_string($name_or_obj)) {
            $this->name = $name_or_obj;
        } else {
            parent::__construct($name_or_obj);
        }
    }

    /**
     * @return string
     * @ignore
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return Team
     * @ignore
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     * @ignore
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @return array
     * @ignore
     */
    public function getInvitedAccounts()
    {
        return $this->invited_accounts;
    }

    /**
     * @return array
     * @ignore
     */
    public function toCreateParams()
    {
        return $this->toArray(array(
            'only' => array(
                'name'
            )
        ));
    }

    /**
     * @param  stdClass $array
     * @param  array $options
     * @return Team
     * @ignore
     */
    public function fromArray($array, $options = array())
    {
        array_key_exists('accounts', $array) && $this->setAccounts($array['accounts']);
        array_key_exists('invited_accounts', $array) && $this->setInvitedAccounts($array['invited_accounts']);

        !isset($options['except']) && $options['except'] = array();
        $options['except'] = array_merge($options['except'], array(
            'accounts',
            'invited_accounts',
        ));

        return parent::fromArray($array, $options);
    }

    /**
     * @param  array $accounts
     * @return SignatureRequest
     * @ignore
     */
    protected function setAccounts($accounts)
    {
        // reset accounts array
        $this->accounts = array();

        foreach ($accounts as $account) {
            $resource = new Account;
            $resource->fromObject($account);

            $this->accounts[] = $resource;
        }

        return $this;
    }

    /**
     * @param  array $accounts
     * @return SignatureRequest
     * @ignore
     */
    protected function setInvitedAccounts($accounts)
    {
        // reset accounts array
        $this->invited_accounts = array();

        foreach ($accounts as $account) {
            $resource = new Account;
            $resource->fromObject($account);

            $this->invited_accounts[] = $resource;
        }

        return $this;
    }
}