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
use HelloSign\Error;
use HelloSign\Client;
use HelloSign\SignatureRequest;
use HelloSign\Signer;
use HelloSign\TemplateSignatureRequest;

class OAuthTest extends AbstractTest
{
    private function getOAuthClient($token) {
        $api_url = $_ENV['API_URL'] == null ? Client::API_URL : $_ENV['API_URL'];
        $oauth_token_url = $_ENV['OAUTH_TOKEN_URL'] == null ? Client::OAUTH_TOKEN_URL : $_ENV['OAUTH_TOKEN_URL'];
        $oauth_client = new Client($token, null, $api_url, $oauth_token_url);
        // $oauth_client->enableDebugMode();

        return $oauth_client;
    }

    /**
     * @group create
     */
    public function testCreateAccount()
    {
        //fails if account has already been created
        $random_email = rand(1, 10000000) . "@example.com";
        $response = $this->client->createAccount(
            new Account($random_email),
            $_ENV['CLIENT_ID'],
            $_ENV['CLIENT_SECRET']
        );

        $this->assertInstanceOf('HelloSign\Account', $response);
        $this->assertInstanceOf('HelloSign\OAuthToken', $response->getOAuthData());

        return $response->getOAuthData();
    }

    /**
     * @depends testCreateAccount
     * @group oauth
     */
    public function testRefreshToken($token)
    {
        $oauth_client = $this->getOAuthClient($token);
        $response = $oauth_client->refreshOAuthToken($token);
        $this->assertInstanceOf('HelloSign\OAuthToken', $response);

        return $response;
    }
}
