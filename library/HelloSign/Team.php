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
     * @param  string $name Name of the new Team
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
        if (array_key_exists('accounts', $array)) {
          $this->setAccounts($array['accounts']);
        }

        if (array_key_exists('invited_accounts', $array)) {
          $this->setInvitedAccounts($array['invited_accounts']);
        }

        if (!isset($options['except'])) {
          $options['except'] = array();
        }

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
