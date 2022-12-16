<?php

declare(strict_types=1);

namespace HelloSignSDK\Test\Api;

use GuzzleHttp;
use HelloSignSDK\Api;
use HelloSignSDK\Configuration;
use HelloSignSDK\Model;
use HelloSignSDK\Test\HelloTestCase;
use HelloSignSDK\Test\TestUtils;
use SplFileObject;

class SignatureRequestApiTest extends HelloTestCase
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

    public function testSignatureRequestBulkCreateEmbeddedWithTemplate()
    {
        $requestClass = Model\SignatureRequestBulkCreateEmbeddedWithTemplateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\BulkSendJobSendResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestBulkCreateEmbeddedWithTemplateRequest::fromArray(
            $requestData
        );
        $obj->setSignerFile(
            new SplFileObject(self::ROOT_FILE_PATH . '/bulk-send-sample.csv'),
        );

        $response = $this->api->signatureRequestBulkCreateEmbeddedWithTemplate($obj);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestBulkSendWithTemplate()
    {
        $requestClass = Model\SignatureRequestBulkSendWithTemplateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\BulkSendJobSendResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestBulkSendWithTemplateRequest::fromArray(
            $requestData
        );
        $obj->setSignerFile(
            new SplFileObject(self::ROOT_FILE_PATH . '/bulk-send-sample.csv'),
        );

        $response = $this->api->signatureRequestBulkSendWithTemplate($obj);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestCancel()
    {
        $this->markTestSkipped('POST /signature_request/cancel/{signature_request_id} skipped');
    }

    public function testSignatureRequestCreateEmbedded()
    {
        $requestClass = Model\SignatureRequestCreateEmbeddedRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestCreateEmbeddedRequest::fromArray(
            $requestData
        );
        $obj->setFile([
            new SplFileObject(self::ROOT_FILE_PATH . '/pdf-sample.pdf'),
        ]);

        $response = $this->api->signatureRequestCreateEmbedded($obj);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestCreateEmbeddedWithTemplate()
    {
        $requestClass = Model\SignatureRequestCreateEmbeddedWithTemplateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestCreateEmbeddedWithTemplateRequest::fromArray(
            $requestData
        );
        $obj->setFile([
            new SplFileObject(self::ROOT_FILE_PATH . '/pdf-sample.pdf'),
        ]);

        $response = $this->api->signatureRequestCreateEmbeddedWithTemplate($obj);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestFiles()
    {
        $this->markTestSkipped('GET /signature_request/files/{signature_request_id}');
    }

    public function testSignatureRequestGet()
    {
        $signatureRequestId = 'fa5c8a0b0f492d768749333ad6fcc214c111e967';

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $response = $this->api->signatureRequestGet($signatureRequestId);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestList()
    {
        $accountId = 'all';

        $responseClass = Model\SignatureRequestListResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $response = $this->api->signatureRequestList($accountId);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestReleaseHold()
    {
        $signatureRequestId = 'fa5c8a0b0f492d768749333ad6fcc214c111e967';

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $response = $this->api->signatureRequestReleaseHold($signatureRequestId);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestRemind()
    {
        $signatureRequestId = 'fa5c8a0b0f492d768749333ad6fcc214c111e967';
        $requestClass = Model\SignatureRequestRemindRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestRemindRequest::fromArray($requestData);

        $response = $this->api->signatureRequestRemind($signatureRequestId, $obj);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestRemove()
    {
        $this->markTestSkipped('POST /signature_request/remove/{signature_request_id} skipped');
    }

    public function testSignatureRequestSend()
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
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestSendWithTemplate()
    {
        $requestClass = Model\SignatureRequestSendWithTemplateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestSendWithTemplateRequest::fromArray(
            $requestData
        );

        $response = $this->api->signatureRequestSendWithTemplate($obj);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestUpdate()
    {
        $signatureRequestId = 'fa5c8a0b0f492d768749333ad6fcc214c111e967';
        $requestClass = Model\SignatureRequestUpdateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestUpdateRequest::fromArray($requestData);

        $response = $this->api->signatureRequestUpdate(
            $signatureRequestId,
            $obj
        );
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }
}
