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

use HelloSign\Client;

abstract class AbstractTest extends \PHPUnit\Framework\TestCase
{
    protected $client;

    protected function setUp()
    {
        $keys = array(
            'API_KEY',
            'CLIENT_ID',
            'CLIENT_SECRET',
            'API_URL',
            'OAUTH_TOKEN_URL'
        );

        foreach ($keys as $key) {
            array_key_exists($key, $_SERVER) && $_ENV[$key] = $_SERVER[$key];
        }


        $api_url = $_ENV['API_URL'] == null ? Client::API_URL : $_ENV['API_URL'];
        $oauth_token_url = $_ENV['OAUTH_TOKEN_URL'] == null ? Client::OAUTH_TOKEN_URL : $_ENV['OAUTH_TOKEN_URL'];
        $this->client = new Client($_ENV['API_KEY'], null, $api_url, $oauth_token_url);
        $this->team_member_1 = "sdk-test-php+test1@hellosign.com";
        $this->team_member_2 = "sdk-test-php+test2@hellosign.com";
        // $this->client->enableDebugMode();

    }
}
