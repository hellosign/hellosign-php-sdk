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

use HelloSign\TemplateSignatureRequest;

/**
 * You must have created a template manually prior to running this test suite
 * @author Steve Gough
 *
 */
class TemplateSignatureRequestTest extends AbstractTest
{
    /**
     * @group create
     */
    public function testSendTemplateSignatureRequest()
    {
        $templates = $this->client->getTemplates();
        $template = $templates[0];

        $request = new TemplateSignatureRequest;
        $request->setTemplateId($template->getId());
        $request->setSubject('Purchase Order');
        $request->setMessage('Glad we could come to an agreement.');

        foreach ($template->getSignerRoles() as $i => $role) {
            $request->setSigner($role->name, "george$i@example.com", "George {$role->name}");
        }
        foreach ($template->getCCRoles() as $i => $role) {
            $request->setCC($role->name, "oscar$i@example.com");
        }
        foreach ($template->getCustomFields() as $i => $field) {
            $request->setCustomFieldValue($field->name, 'My String');
        }

        $response = $this->client->sendTemplateSignatureRequest($request);

        $this->assertInstanceOf('HelloSign\SignatureRequest', $response);
        $this->assertNotNull($response->getId());

        return $response->getId();
    }

    /**
     * @group create
     */
    public function testSendTemplateSignatureRequestWithSignerGroup()
    {
        // Retrieve Template Information
        $templates = $this->client->getTemplates();
        $template = $templates[0];
        $signer_role = $template->getSignerRoles()[0]->name;

        // Enable Test Mode
        $request = new TemplateSignatureRequest;

        // Set Request Params
        $request->setTemplateId($template->getId());
        $request->setSubject('Purchase Order');
        $request->setMessage('Glad we could come to an agreement.');

        // Add Signer Group to Signature Request
        $request->addGroup("Client Group", $signer_role);
        $request->addGroupSigner("Jack Example", "jack@example.com", 0, $signer_role);
        $request->addGroupSigner("Jill Example", "jill@example.com", 1, $signer_role);
        $request->addGroupSigner("Jane Example", "jane@example.com", 2, $signer_role);

        $response = $this->client->sendTemplateSignatureRequest($request);

        $this->assertInstanceOf('HelloSign\SignatureRequest', $response);
        $this->assertNotNull($response->getId());

        return $response->getId();
    }
}
