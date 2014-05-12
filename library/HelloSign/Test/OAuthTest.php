<?php

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
        
		if($api_url != Client::API_URL) {
        	$oauth_client->disableCertificateCheck();
        }
        
        return $oauth_client;
	}

    /**
     * @group create
     */
    public function testCreateAccount()
    {               
        $response = $this->client->createAccount(
			            new Account(
			                $this->team_member_1,
			                'ASecurePassword'
			            ),
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
    
	/**
     * @depends testRefreshToken
     * @group oauth 
     */
    public function testSendSignatureRequest($token)
    {
        $oauth_client = $this->getOAuthClient($token);
        $request = new SignatureRequest;
        $request->enableTestMode();

        // Set Request Param Signature Request
        $request->setTitle("NDA with Acme Co.");
        $request->setSubject("The NDA we talked about");
        $request->setMessage("Please sign this NDA and then we can discuss more. Let me know if you have any questions.");
        $request->addSigner("jack@example.com", "Jack", 0);
        $request->addSigner(new Signer(array(
            'name'          => "Jill",
            'email_address' => "jill@example.com",
        	'order'			=> 1
        )));
        $request->addCC("lawyer@example.com");
        $request->addFile(__DIR__ . '/nda.docx');

        // Send Signature Request
        $response = $oauth_client->sendSignatureRequest($request);
        
        $this->assertInstanceOf('HelloSign\SignatureRequest', $response);
        $this->assertNotNull($response->getId());
        $this->assertEquals($request, $response);
        $this->assertEquals($response->getTitle(), $response->title);
        
        return $token;
    }
    
	/**
     * @depends testSendSignatureRequest
     * @group oauth 
     */
    public function testGetSignatureRequestList($token)
    {
        $oauth_client = $this->getOAuthClient($token);
        $signature_requests = $oauth_client->getSignatureRequests();
        $signature_request = $signature_requests[0];

        $signature_request2 = $oauth_client->getSignatureRequest($signature_request->getId());


        $this->assertInstanceOf('HelloSign\SignatureRequestList', $signature_requests);
        $this->assertGreaterThan(0, count($signature_requests));

        $this->assertInstanceOf('HelloSign\SignatureRequest', $signature_request);
        $this->assertNotNull($signature_request->getId());

        $this->assertInstanceOf('HelloSign\SignatureRequest', $signature_request2);
        $this->assertNotNull($signature_request2->getId());

        $this->assertEquals($signature_request, $signature_request2); 
        
        return $token;
    }
}
