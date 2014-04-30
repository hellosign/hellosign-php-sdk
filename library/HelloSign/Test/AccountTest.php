<?php

namespace HelloSign\Test;

use HelloSign\Account;

class AccountTest extends AbstractTest
{
    /**
     * @expectedException HelloSign\Error
     * @expectedExceptionMessage This account already exists, please log in
     * @group create
     */
    public function testCreateAccount()
    {
        $response = $this->client->createAccount(
            new Account(
                'abc@xyz.com',
                '12345678'
            )
        );

        $this->assertInstanceOf('HelloSign\Account', $response);
        $this->assertNotNull($account->getId());

        return $response;
    }

    /**
     * @group update
     */
    public function testUpdateAccount()
    {
        $callback_url = $_ENV['HELLOSIGN_CALLBACK_URL'];
        $account = new Account;
        $account->setCallbackUrl($callback_url);
        $response = $this->client->updateAccount($account);

        $this->assertInstanceOf('HelloSign\Account', $response);
        $this->assertNotNull($response->getId());
        $this->assertEquals($response->getCallbackUrl(), $callback_url);
        $this->assertEquals($response, $account);

        return $response;
    }

    /**
     * @group read
     */
    public function testGetAcount()
    {
        $response = $this->client->getAccount();

        $this->assertInstanceOf('HelloSign\Account', $response);
        $this->assertNotNull($response->getId());

        return $response;
    }

    /**
     * @depends testGetAcount
     * @group read
     */
    public function testIsAccountValid($account)
    {
        $this->assertTrue($this->client->isAccountValid($account->getEmail()));

        $this->assertFalse($this->client->isAccountValid('abc123@xyz456.com'));
    }
}