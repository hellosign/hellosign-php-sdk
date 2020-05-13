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

use HelloSign\SignatureRequest;
use HelloSign\UnclaimedDraft;

class UnclaimedDraftTest extends AbstractTest
{
    /**
     * @group create
     */
    public function testCreateEmbeddedUnclaimedDraft()
    {
        $account = $this->client->getAccount();

        $request = new SignatureRequest;
        $request->setRequesterEmail($account->getEmail());
        $request->setTitle('NDA with Acme Co.');
        $request->setSubject('The NDA we talked about');
        $request->setMessage('Please sign this NDA and let\'s discuss.');
        $request->addSigner('bale@example.com', 'Bale');
        $request->addSigner('beck@example.com', 'Beck');
        $request->addCC('ancelotti@example.com');
        $request->addFile(__DIR__ . '/nda.docx');
        $request->addAttachment('Passport', 0, 'Attach your passport', false);
        $client_id = $_ENV['CLIENT_ID'];
        $draft = new UnclaimedDraft($request, $client_id);
        $draft->setUsePreexistingFields(true);

        $response = $this->client->createUnclaimedDraft($draft);
        $sign_url = $response->getClaimUrl();


        $this->assertInstanceOf('HelloSign\UnclaimedDraft', $response);
        $this->assertNotNull($response);
        $this->assertEquals($draft, $response);

        $this->assertNotEmpty($sign_url);
    }

    /**
     * The difference is that you don't set a client id here
     * @group create
     */
    public function testCreateUnclaimedDraft()
    {
        $request = new SignatureRequest;
        $request->addFile(__DIR__ . '/nda.docx');

        $draft = new UnclaimedDraft($request);

        $response = $this->client->createUnclaimedDraft($draft);
        $sign_url = $response->getClaimUrl();


        $this->assertInstanceOf('HelloSign\UnclaimedDraft', $response);
        $this->assertNotNull($response);
        $this->assertEquals($draft, $response);

        $this->assertNotEmpty($sign_url);
    }

    /**
     * @group embedded
     */
    public function testCreateUnclaimedDraftEmbeddedWithTemplate()
    {
        $client_id = $_ENV['CLIENT_ID'];

        $templates = $this->client->getTemplates();
        $template = $templates[0];
        $templateId = $template->getId();

        $baseReq = new \HelloSign\TemplateSignatureRequest();
        $baseReq->setTemplateId($templateId);
        foreach ($template->getSignerRoles() as $i => $role) {
            $baseReq->setSigner($role->name, "signer".$i."@example.com", "signer $i");
        }
        $baseReq->setSigningRedirectUrl('http://hogwarts.edu/success');
        $baseReq->setRequestingRedirectUrl('http://hogwarts.edu');
        $baseReq->setRequesterEmailAddress('herman@hogwarts.com');
        $baseReq->addMetadata('House', 'Griffyndor');

        $request = new \HelloSign\EmbeddedSignatureRequest($baseReq);
        $request->setClientId($client_id);
        $request->setEmbeddedSigning();

        $response = $this->client->createUnclaimedDraftEmbeddedWithTemplate($request);

        $this->assertTrue($response instanceof \HelloSign\UnclaimedDraft);
    }
}
