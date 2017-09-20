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

use HelloSign\ApiApp;

class ApiAppTest extends AbstractTest
{
    /**
    * @expectedException HelloSign\Error
    * @expectedExceptionMessage An app with the same name already exists
    * @group create
    */
    public function testCreateApiApp()
    {
        $wl = array('primary_button_color' => '#626567', 'primary_button_text_color' => '#ffffff');
        $wl = json_encode($wl);

        $name = "Test" . rand(1, 2000);
        $domain = "www.testdomain.com";
        $callback = "http://www.testcallback.com";
        $logo = __DIR__ . "/logo.jpg";

        $app = new ApiApp;
        $app->setName($name);
        $app->setDomain($domain);
        $app->setCallbackUrl($callback);
        $app->setLogo($logo);
        $app->setWhiteLabeling($wl);
        $app->setInsertEverywhere(false);

        $response = $this->client->createApiApp($app);

        $this->assertNotNull($response->getClientId());

        //trying to create it again should fail

        $duplicate_app = new ApiApp;
        $duplicate_app->setName($name);
        $duplicate_app->setDomain($domain);
        $duplicate_app->setCallbackUrl($callback);
        $duplicate_app->setLogo($logo);
        $duplicate_app->setWhiteLabeling($wl);

        $second_response = $this->client->createApiApp($duplicate_app);
        //
        return $second_response;
    }

    /**
    * @group oauth
    */
    public function testCreateOauthApiApp()
    {
        $name = "Test Oauth" . rand(1, 2000);
        $domain = "www.testdomain.com";
        $callback = "http://www.testcallback.com";
        $logo = __DIR__ . "/logo.jpg";
        $oauth_callback = "http://www.OAuthCallbackTest.com";
        $oauth_scope = "basic_account_info,request_signature";

        $app = new ApiApp;
        $app->setName($name);
        $app->setDomain($domain);
        $app->setCallbackUrl($callback);
        $app->setLogo($logo);
        $app->setOauthOptions($oauth_callback, $oauth_scope);

        $response = $this->client->createApiApp($app);

        $this->assertNotNull($response->getClientId());
        $this->assertEquals($response->name, $name);
        $this->assertNotNull($response->oauth);

        return $response;
    }
    //
    // /**
    //  * @group update
    //  */
    // public function testUpdateAccount()
    // {
    //     $callback_url = $_ENV['CALLBACK_URL'];
    //     $account = new Account;
    //     $account->setCallbackUrl($callback_url);
    //     $response = $this->client->updateAccount($account);
    //
    //     $this->assertInstanceOf('HelloSign\Account', $response);
    //     $this->assertNotNull($response->getId());
    //     $this->assertEquals($response->getCallbackUrl(), $callback_url);
    //     $this->assertEquals($response, $account);
    //
    //     return $response;
    // }

    /**
     * @group read
     */
    public function testGetApiApp()
    {
        $app_name = "Test" . rand(1, 2000);
        $domain = "www.testdomain.com";
        $callback_url = "http://www.testcallback.com";
        $custom_logo_file = (__DIR__ . '/logo.jpg');

        $response = $this->client->createApiApp(
            new ApiApp($app_name, $domain, $callback_url, $custom_logo_file, $white_labeling_options)
        );

        $client_id = $response->getClientId();

        $app = $this->client->getApiApp($client_id);

        $this->assertNotNull($response->name);
        $this->assertNotNull($response->callback_url);
        $this->assertNotNull($response->white_labeling_options);

    }

    /**
     * @depends testGetAcount
     * @group read
     */
    // public function testIsAccountValid($account)
    // {
    //     $this->assertTrue($this->client->isAccountValid($account->getEmail()));
    //
    //     $this->assertFalse($this->client->isAccountValid('abc123@xyz456.com'));
    // }
}
