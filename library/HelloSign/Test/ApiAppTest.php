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
    private function generateApiAppName(string $prefix): string
    {
        $guid = TestUtils::generateGuid(8);
        return $prefix . $guid;
    }

    /**
    * @expectedException HelloSign\Error
    * @expectedExceptionMessage An app with the same name already exists
    * @group create
    */
    public function testCreateApiApp()
    {
        $wl = array('primary_button_color' => '#626567', 'primary_button_text_color' => '#ffffff');
        $wl = json_encode($wl);

        $name = $this->generateApiAppName('Test');
        $domain = "www.testdomain.com";
        $callback = $_ENV['CALLBACK_URL'];
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

        return $second_response;
    }

    /**
    * @group oauth
    */
    public function testCreateOauthApiApp()
    {
        $name = $this->generateApiAppName('Test Oauth');
        $domain = "www.testdomain.com";
        $callback = $_ENV['CALLBACK_URL'];
        $logo = __DIR__ . "/logo.jpg";
        $oauth_callback = $_ENV['CALLBACK_URL'];
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

    /**
     * @group update
     */
    public function testUpdateApiApp()
    {

        $name = $this->generateApiAppName('Test');
        $domain = "www.testdomain.com";

        $app = new ApiApp;
        $app->setName($name);
        $app->setDomain($domain);

        $response = $this->client->createApiApp($app);
        $client_id = $response->getClientId();

        $callback = "http://www.testcallback.com";

        $update = new ApiApp;
        $update->setCallbackUrl($callback);
        $updated_response = $this->client->updateApiApp($client_id, $update);

        $this->assertInstanceOf('HelloSign\ApiApp', $response);
        $this->assertEquals($updated_response->getCallbackUrl(), $callback);

        return $response;
    }

    /**
     * @group read
     */
    public function testGetApiApp()
    {
        $name = $this->generateApiAppName('Test');
        $domain = "www.testdomain.com";
        $callback_url = $_ENV['CALLBACK_URL'];

        $app = new ApiApp;
        $app->setName($name);
        $app->setDomain($domain);
        $app->setCallbackUrl($callback_url);

        $response = $this->client->createApiApp($app);
        $client_id = $response->getClientId();

        $app = $this->client->getApiApp($client_id);

        $this->assertNotNull($app->name);
        $this->assertNotNull($app->callback_url);
        $this->assertNotNull($app->domain);

    }

    /**
     * @group delete
     * @expectedException HelloSign\Error
     * @expectedExceptionMessage Not found
     */
    public function testDeleteApiApp()
    {
        # Note that we won't be actually deleting an API app,
        # but rather checking to make sure we get a Not found error

        $client_id = 'c7e5031edf091e76796088e4e06443e9'; #random

        $response = $this->client->deleteApiApp($client_id);
    }

    /**
     * @group list
     */
    public function testGetApiApps()
    {
        $list = $this->client->getApiApps(1, 1);

        $this->assertNotNull($list);
        $this->assertCount(1, $list);
    }
}
