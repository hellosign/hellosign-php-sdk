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

use HelloSign\Error;
use HelloSign\Template;

/**
 *
 * You must have created a template manually prior to running this test suite
 * @author Steve Gough
 *
 */
class TemplateTest extends AbstractTest
{
    /**
     * @group read
     */
    public function testGetTemplatesWithPageNotFound()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage("Page not found");
        $templates = $this->client->getTemplates(9999, 1);
    }

    /**
     * @group read
     */
    public function testGetTemplates()
    {
        $templates = $this->client->getTemplates();
        $template = $templates[0];

        $template2 = $this->client->getTemplate($template->getId());

        $this->assertInstanceOf('HelloSign\TemplateList', $templates);
        $this->assertGreaterThan(0, count($templates));

        $this->assertInstanceOf('HelloSign\Template', $template);
        $this->assertNotNull($template->getId());

        $this->assertInstanceOf('HelloSign\Template', $template2);
        $this->assertNotNull($template2->getId());

        $this->assertEquals($template, $template2);

        return $template;
    }

    /**
     * @depends testGetTemplates
     * @group update
     */
    public function testAddTemplateUser($template)
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage("Account does not belong to your team");
        $invite = $this->client->inviteTeamMember($this->team_member_2);
        $response = $this->client->addTemplateUser($template->getId(), $this->team_member_2);

        $this->assertInstanceOf('HelloSign\Error', $response);
    }

    /**
     * @depends testGetTemplates
     * @group update
     */
    public function testRemoveTemplateUser($template)
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage("Account does not belong to your team");
        $response = $this->client->removeTemplateUser($template->getId(), $this->team_member_2);

        $this->assertInstanceOf('HelloSign\Error', $response);
    }

    /**
     * @group embedded
     */
    public function testCreateEmbeddedDraft()
    {
        $client_id = $_ENV['CLIENT_ID'];

        $request = new Template();
        $request->setClientId($client_id);
        $request->addFile(__DIR__ . '/nda.docx');
        $request->setTitle('Test Title');
        $request->setSubject('Test Subject');
        $request->setMessage('Test Message');
        $request->addSignerRole('Test Role', 1);
        $request->addSignerRole('Test Role 2', 2);
        $request->addCCRole('Test CC Role');
        $request->addMergeField('Test Merge', 'text');
        $request->addMergeField('Test Merge 2', 'checkbox');
        $request->addMetadata('custom_id', '1234');
        $request->addMetadata('favorite_movie', 'Big Fish');
        $request->setUsePreexistingFields(true);
        $request->addAttachment('Passport', 0, 'Attach your passport', false);

        $return = $this->client->createEmbeddedDraft($request);

        $this->assertTrue(is_string($return->getId()));
        $this->assertTrue(is_string($return->getEditUrl()));
        $this->assertTrue($return->isEmbeddedDraft());
        return $return->getId();
    }

    /**
     * @group embedded
     */
    public function testGetEmbeddedEditUrl()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage("Template not found");
        # Similar to the delete_template function, we can't actually test this for success without human interaction.
        # Instead, we'll be checking for a 404 - Template not found status code, which means our parameters are correct

        $template_id = 'ax5d921d0d3ccfcd594d2b8c897ba774d89c9234'; #random

        $res = $this->client->getEmbeddedEditUrl($template_id);
    }

    /**
     * @group embedded
     */
    public function testDeleteTemplate()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage("Template not found");
        # Note that we won't be actually deleting a template,
        # but rather checking to make sure we get a 404 - Template not found error

        $template_id = 'ax5d921d0d3ccfcd594d2b8c897ba774d89c9234'; #random

        $res = $this->client->deleteTemplate($template_id);
    }

    /**
     * @group read
     * @group download
     * @group newTemplate
     */
    public function testGetTemplateFiles()
    {
        $templates = $this->client->getTemplates();
        $template_id = $templates[0]->getId();

        $file1 = 'phpunit_test_template_file.pdf';
        if (file_exists($file1)) {
            unlink($file1);
        }

        $response = $this->client->getTemplateFiles($template_id, $file1);
        $this->assertGreaterThan(0, filesize($file1));

        return $response;
    }

    /**
     * @group updateFile
     */
    public function testUpdateTemplateFiles()
    {
        $templates = $this->client->getTemplates();
        $template_id = $templates[0]->getId();
        $client_id = $_ENV['CLIENT_ID'];

        $request = new Template();
        $request->setClientId($client_id);
        $request->addFile(__DIR__ . '/nda.docx');
        $request->setMessage('PHP SDK Test Update File Message');
        $request->setSubject('PHP SDK Test Update File Subject');

        $response = $this->client->updateTemplateFiles($template_id, $request);
        $this->assertTrue(is_string($response->getId()));
        return $response;
    }
}
