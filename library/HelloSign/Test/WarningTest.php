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

class WarningTest extends AbstractTest
{

  public function testWarnings()
  {
    $response = $this->client->getSignatureRequests();
    // print_r($response->getWarnings());
    $this->assertTrue(is_array($response->getWarnings()));
  }

  public function localWarningsTest()
  {
    $fake_response = array(
        "account" => array(
            "account_id" => "5008b25c7f67153e57d5a357b1687968068fb465",
            "email_address" => "me@hellosign.com",
            "is_paid_hs" => true,
            "is_paid_hf" => false,
            "quotas" => array(
                "api_signature_requests_left" => 1250,
                "documents_left" => null,
                "templates_left" => null
            ),
            "callback_url" => null,
            "role_code" => null
          ),
        "warnings" => array(
            array(
              "message" => "derp derp",
              "name" => "some_error"
            ),
            array(
              "message" => "derp derp 2",
              "name" => "some_other_error"
            )
          )
        );

    $account = new Account();
    $account->fromResponse($fake_response);
    $this->assertTrue($account->warnings[0]->getMessage(), "derp derp");
    $this->assertTrue($account->warnings[0] instanceof Warning, true);
  }

}
