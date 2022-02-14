<?php

namespace HelloSignSDK\Test\Api;

use GuzzleHttp;
use GuzzleHttp\Psr7;
use HelloSignSDK\Api;
use HelloSignSDK\Configuration;
use HelloSignSDK\Model;
use HelloSignSDK\Test\HelloTestCase;
use HelloSignSDK\Test\TestUtils;

class SignatureRequestTest extends HelloTestCase
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
            $this->client,
            Configuration::getDefaultConfiguration()
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

        $response = $this->api->signatureRequestBulkCreateEmbeddedWithTemplate($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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

        $response = $this->api->signatureRequestBulkSendWithTemplate($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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

        $response = $this->api->signatureRequestCreateEmbedded($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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

        $response = $this->api->signatureRequestCreateEmbeddedWithTemplate($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestFiles()
    {
        $fileType = 'pdf';
        $getUrl = false;
        $getDataUri = false;

        $responseClass = Model\FileResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $response = $this->api->signatureRequestFiles(
            $fileType,
            $getUrl,
            $getDataUri
        );
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestGet()
    {
        $signatureRequestId = 'fa5c8a0b0f492d768749333ad6fcc214c111e967';

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $response = $this->api->signatureRequestGet($signatureRequestId);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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

        $response = $this->api->signatureRequestSend($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testSignatureRequestSendFileForcesMultipartFormData()
    {
        $requestClass = Model\SignatureRequestSendRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['with_file'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestSendRequest::fromArray($requestData);

        $response = $this->api->signatureRequestSend($obj);
        $request = $this->handler->getLastRequest();
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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

        $body = TestUtils::streamToArray($request->getBody());
        $body = TestUtils::removeRootPathFromFiles($body);

        /*
         * We expect non-scalar params to be JSON stringified in
         * multipart/form-data endpoints,
         * except for binary (file uploads) params,
         * where binary params are supported and used in the current request.
         */
        $this->assertEquals(
            $requestData['signers'],
            json_decode($body['signers'], true),
        );

        $this->assertEquals(
            $requestData['file'][0],
            $body['file[0]'],
        );

        $this->assertEquals(
            $requestData['file'][1],
            $body['file[1]'],
        );
    }

    public function testSignatureRequestSendNoFileForcesApplicationJson()
    {
        $requestClass = Model\SignatureRequestSendRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['with_file_url'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestSendRequest::fromArray($requestData);

        $response = $this->api->signatureRequestSend($obj);
        $request = $this->handler->getLastRequest();
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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

        $body = json_decode($request->getBody()->getContents(), true);

        /*
         * We expect non-scalar params to be JSON stringified in
         * application/json endpoints where binary (file uploads) params are
         * supported but not used in the current request.
         */
        $this->assertEquals(
            $requestData['signers'],
            json_decode($body['signers'], true),
        );

        $this->assertEquals(
            $requestData['file_url'],
            json_decode($body['file_url'], true),
        );
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
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

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
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }
}
