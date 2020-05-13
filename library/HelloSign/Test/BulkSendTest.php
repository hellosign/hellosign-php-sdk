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

use HelloSign\Template;
use HelloSign\BulkSendJob;
use HelloSign\EmbeddedBulkSendJob;

class BulkSendTest extends AbstractTest
{
  /**
   * @group initiate
   */
  public function testBulkSendJobClass()
  {
   $stub = $this->createMock(BulkSendJob::class);
   $this->assertClassHasAttribute('test_mode', BulkSendJob::class);
   $this->assertClassHasAttribute('allow_decline', BulkSendJob::class);
   $this->assertClassHasAttribute('template_ids', BulkSendJob::class);
   $this->assertClassHasAttribute('title', BulkSendJob::class);
   $this->assertClassHasAttribute('subject', BulkSendJob::class);
   $this->assertClassHasAttribute('message', BulkSendJob::class);
   $this->assertClassHasAttribute('signing_redirect_url', BulkSendJob::class);
   $this->assertClassHasAttribute('signer_file', BulkSendJob::class);
   $this->assertClassHasAttribute('signer_list', BulkSendJob::class);
   $this->assertClassHasAttribute('custom_fields', BulkSendJob::class);
   $this->assertClassHasAttribute('ccs', BulkSendJob::class);
   $this->assertClassHasAttribute('metadata', BulkSendJob::class);
   $this->assertClassHasAttribute('client_id', BulkSendJob::class);
  }

  /**
   * @group send
   */
  public function testSendBulkSendJobWithSignerFile()
  {
   $templates = $this->client->getTemplates();
   $template = $templates[0];

   $signers = __DIR__ . "/bulk_send_test_signers.csv";

   $request = new BulkSendJob;
   $request->setTitle('Bulk Send Job Example Title');
   $request->setTemplateId($template->getId());
   $request->addSignerFile($signers);

   $response = $this->client->sendBulkSendJobWithTemplate($request);

   $this->assertInstanceOf('HelloSign\BulkSendJob', $response);
   $this->assertNotNull($response->getId());
  }

  /**
   * @group send
   */
  public function testSendBulkSendJobWithSignerList()
  {
   $templates = $this->client->getTemplates();
   $template = $templates[0];
   $signer_role = $template->getSignerRoles()[0]->name;
   $custom_field = $template->getCustomFields()[0]->name;

   $signers = array(
     array(
       "signers" => array(
         $signer_role => array(
           "name" => "Adam HelloSign",
           "email_address" => "test1@example.com",
           "pin" => "1234"
         )
       )
     ),
     array(
       "signers" => array(
         $signer_role => array(
           "name" => "Jane HelloSign",
           "email_address" => "test2@example.com"
         )
       ),
       "custom_fields" => array(
         $custom_field => "123 Main St."
       )
     )
   );

   $request = new BulkSendJob;
   $request->setTitle('Bulk Send Job Example Title');
   $request->setTemplateId($template->getId());
   $request->addSignerList($signers);

   $response = $this->client->sendBulkSendJobWithTemplate($request);

   $this->assertInstanceOf('HelloSign\BulkSendJob', $response);
   $this->assertNotNull($response->getId());
  }

  /**
   * @group sendWithParametersEnabled
   */
  public function testSendBulkSendJobWithAllParameters()
  {
   $templates = $this->client->getTemplates();
   $template = $templates[0];
   $field = $template->getCustomFields()[0];
   $cc = $template->getCCRoles()[0];
   $app = $this->client->getApiApps()[0];
   $app_id = $app->getClientId();

   $signers = __DIR__ . "/bulk_send_test_signers.csv";

   $request = new BulkSendJob;
   $request->enableAllowDecline();
   $request->setTemplateId($template->getId());
   $request->setTitle('Bulk Send Job With All Parameters');
   $request->setSubject('Bulk Send Job Subject');
   $request->setMessage('Bulk Send Job Message');
   $request->setSigningRedirectUrl('http://www.calbears.com');
   $request->addSignerFile($signers);

   if (isset($field)) {
     $request->setCustomFieldValue($field->name, 'Test Test');
   }

   if (isset($cc)) {
     $request->setCC($cc->name, 'cc@example.com');
   }

   $request->addMetadata('user_id', '1234');
   $request->setClientId($app_id);

   $response = $this->client->sendBulkSendJobWithTemplate($request);

   $this->assertInstanceOf('HelloSign\BulkSendJob', $response);
   $this->assertNotNull($response->getId());
  }

  /**
   * @group embedded
   */
  public function testSendEmbeddedBulkSendJob()
  {
   $templates = $this->client->getTemplates();
   $template = $templates[0];

   $signers = __DIR__ . "/bulk_send_test_signers.csv";

   $request = new BulkSendJob;
   $request->setTitle('Embedded Bulk Send Job Example Title');
   $request->setTemplateId($template->getId());
   $request->addSignerFile($signers);

   // Turn it into an embedded request
   $client_id = $_ENV['CLIENT_ID'];
   $embedded_request = new EmbeddedBulkSendJob($request, $client_id);

   // Send it to HelloSign
   $response = $this->client->sendEmbeddedBulkSendJobWithTemplate($embedded_request);

   $this->assertInstanceOf('HelloSign\BulkSendJob', $response);
   $this->assertNotNull($response->getId());
  }

  /**
   * @group list
   */
  public function testGetBulkSendJobs()
  {
    // Testing default getBulkSendJobs()
    $list = $this->client->getBulkSendJobs();
    $this->assertNotNull($list);
    $this->assertEquals($list->getPageSize(), 20);
    $this->assertEquals($list->getPage(), 1);
  }

  /**
   * @group list
   */
  public function testGetBulkSendJobsWithParams()
  {
    // Testing parameters for getBulkSendJobs()
    $list = $this->client->getBulkSendJobs(2, 5);
    $this->assertNotNull($list);
    $this->assertEquals($list->getPageSize(), 5);
    $this->assertEquals($list->getPage(), 2);
  }

  /**
   * @group read
   */
  public function testGetBulkSendJob()
  {
   $templates = $this->client->getTemplates();
   $template = $templates[0];

   $signers = __DIR__ . "/bulk_send_test_signers.csv";

   $request = new BulkSendJob;
   $request->setTitle('Bulk Send Job Example Title');
   $request->setTemplateId($template->getId());
   $request->addSignerFile($signers);

   $response = $this->client->sendBulkSendJobWithTemplate($request);
   $id = $response->getId();

   $bulk_send_job = $this->client->getBulkSendJob($id);
   $requests = $bulk_send_job->getSignatureRequests();

   $this->assertNotNull($bulk_send_job->getId());
   $this->assertNotNull($bulk_send_job->getSignatureRequests());
  }
}

?>
