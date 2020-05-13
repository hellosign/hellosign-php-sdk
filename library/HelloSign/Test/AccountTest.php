<?php

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

namespace HelloSign\Test;

use HelloSign\Account;

class AccountTest extends AbstractTest
{
    /**
     * @expectedException HelloSign\Error
     * @expectedExceptionMessage Account already exists
     * @group create
     */
    public function testCreateAccount()
    {
        $random_email = rand(1, 10000000) . "@example.com";
        $response = $this->client->createAccount(
            new Account($random_email)
        );

        $this->assertInstanceOf('HelloSign\Account', $response);
        $this->assertNotNull($response->account_id);

        //trying to create it again should fail
        $response = $this->client->createAccount(
            new Account($random_email)
        );

        return $response;
    }

    /**
     * @group update
     */
    public function testUpdateAccount()
    {
        $callback_url = $_ENV['CALLBACK_URL'];
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
        $this->assertNotNull($response->account_id);

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
