<?php

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
        $request->enableTestMode();
        $request->setRequesterEmail($account->getEmail());
        $request->setTitle('NDA with Acme Co.');
        $request->setSubject('The NDA we talked about');
        $request->setMessage('Please sign this NDA and let\'s discuss.');
        $request->addSigner('bale@example.com', 'Bale');
        $request->addSigner('beck@example.com', 'Beck');
        $request->addCC('ancelotti@example.com');
        $request->addFile(__DIR__ . '/nda.docx');

        $client_id = $_ENV['CLIENT_ID'];
        $draft = new UnclaimedDraft($request, $client_id);

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
        $request->enableTestMode();
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
        $baseReq->setSigner('Signer', 'harry@potter.net', 'Harry Potter');
        $baseReq->setSigningRedirectUrl('http://hogwarts.edu/success');
        $baseReq->setRequestingRedirectUrl('http://hogwarts.edu');
        $baseReq->setRequesterEmailAddress('herman@hogwarts.com');
        $baseReq->addMetadata('House', 'Griffyndor');

        $request = new \HelloSign\EmbeddedSignatureRequest($baseReq);
        $request->setClientId($client_id);
        $request->enableTestMode();
        $request->setEmbeddedSigning();

        $response = $this->client->createUnclaimedDraftEmbeddedWithTemplate($request);

        $this->assertTrue($response instanceof \HelloSign\UnclaimedDraft);
    }
}
