<?php

declare(strict_types=1);

namespace HelloSignSDK\Test\Api;

use GuzzleHttp;
use GuzzleHttp\Psr7;
use HelloSignSDK\Api;
use HelloSignSDK\Configuration;
use HelloSignSDK\Model;
use HelloSignSDK\ObjectSerializer;
use HelloSignSDK\Test\HelloTestCase;
use HelloSignSDK\Test\TestUtils;
use SplFileObject;

class ObjectSerializerTest extends HelloTestCase
{
    /** @var Api\SignatureRequestApi */
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new GuzzleHttp\Client([
            'handler' => GuzzleHttp\HandlerStack::create($this->handler),
        ]);

        $this->api = new Api\SignatureRequestApi(
            Configuration::getDefaultConfiguration(),
            $this->client,
        );
    }

    public function testFileForcesMultipartFormData()
    {
        $requestClass = Model\SignatureRequestSendRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestSendRequest::fromArray($requestData);
        $obj->setFile([
            new SplFileObject(self::ROOT_FILE_PATH . '/pdf-sample.pdf'),
        ]);

        $response = $this->api->signatureRequestSend($obj);
        $request = $this->handler->getLastRequest();
        $serialized = TestUtils::toArray($response);

        $this->assertEquals(
            'multipart/form-data',
            $request->getHeaderLine('Accept')
        );
        $this->assertInstanceOf(
            Psr7\MultipartStream::class,
            $request->getBody()
        );

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
    }

    public function testNoFileForcesApplicationJson()
    {
        $requestClass = Model\SignatureRequestSendRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestSendRequest::fromArray($requestData);

        $response = $this->api->signatureRequestSend($obj);
        $request = $this->handler->getLastRequest();
        $serialized = TestUtils::toArray($response);

        $this->assertEquals(
            'application/json',
            $request->getHeaderLine('Accept')
        );
        $this->assertInstanceOf(
            Psr7\Stream::class,
            $request->getBody()
        );

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
    }

    public function testValuesJsonified()
    {
        $oauth = new Model\SubOAuth();
        $oauth->setCallbackUrl('https://oauth-callback.test')
            ->setScopes([Model\SubOAuth::SCOPES_TEMPLATE_ACCESS]);

        $customLogoFile = new SplFileObject(self::ROOT_FILE_PATH . '/pdf-sample.pdf');

        $obj = new Model\ApiAppCreateRequest();
        $obj->setName('My name is')
            ->setCallbackUrl('https://awesome.test')
            ->setDomains(['domain1.com', 'domain2.com'])
            ->setOauth($oauth)
            ->setCustomLogoFile($customLogoFile);

        $result = ObjectSerializer::getFormParams($obj);

        $this->assertEquals($obj->getName(), $result['name']);
        $this->assertEquals($obj->getCallbackUrl(), $result['callback_url']);
        $this->assertEquals($obj->getDomains(), json_decode($result['domains'], true));

        $expectedOauth = json_encode([
            'callback_url' => $oauth->getCallbackUrl(),
            'scopes' => $oauth->getScopes(),
        ]);

        $this->assertEquals($expectedOauth, $result['oauth']);
    }
}
