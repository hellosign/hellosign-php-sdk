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

    /** @var string */
    protected $rootFilePath;

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

        $this->rootFilePath = Configuration::getDefaultConfiguration()
            ->getRootFilePath();
    }

    public function testSingleFileInstantiated()
    {
        $obj = Model\ApiAppCreateRequest::fromArray([
            'custom_logo_file' => 'pdf-sample.pdf',
        ]);

        $expected = new SplFileObject("{$this->rootFilePath}/pdf-sample.pdf");

        $this->assertEquals($expected, $obj->getCustomLogoFile());
    }

    public function testMultipleFilesInstantiated()
    {
        $obj = Model\SignatureRequestSendRequest::fromArray([
            'file' => ['pdf-sample.pdf'],
        ]);

        $expected = new SplFileObject("{$this->rootFilePath}/pdf-sample.pdf");

        $this->assertEquals($expected, $obj->getFile()[0]);
    }

    public function testFilesNotInstantiatedIfFlagNotTrue()
    {
        Configuration::getDefaultConfiguration()->setInstantiateFiles(false);

        $filename = 'pdf-sample.pdf';

        /** @var Model\ApiAppCreateRequest $obj */
        $obj = ObjectSerializer::instantiateFiles(
            Model\ApiAppCreateRequest::class,
            ['custom_logo_file' => $filename]
        );

        $this->assertSame($filename, $obj['custom_logo_file']);

        Configuration::getDefaultConfiguration()->setInstantiateFiles(true);

        /** @var Model\ApiAppCreateRequest $obj */
        $obj = ObjectSerializer::instantiateFiles(
            Model\ApiAppCreateRequest::class,
            ['custom_logo_file' => $filename]
        );

        $expected = new SplFileObject("{$this->rootFilePath}/{$filename}");

        $this->assertEquals($expected, $obj['custom_logo_file']);
    }

    public function testFileForcesMultipartFormData()
    {
        $requestClass = Model\SignatureRequestSendRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['with_file'];

        $responseClass = Model\SignatureRequestGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\SignatureRequestSendRequest::fromArray($requestData);

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

        $body = TestUtils::streamToArray($request->getBody());

        $expectedFile1Contents = $obj->getFile()[0]->fread(10000);
        $expectedFile1Contents = str_replace("\r", '', trim($expectedFile1Contents));

        $expectedFile2Contents = $obj->getFile()[1]->fread(10000);
        $expectedFile2Contents = str_replace("\r", '', trim($expectedFile2Contents));

        $this->assertSame($expectedFile1Contents, $body['file[0]']);
        $this->assertSame($expectedFile2Contents, $body['file[1]']);
    }

    public function testNoFileForcesApplicationJson()
    {
        $requestClass = Model\SignatureRequestSendRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['with_file_url'];

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
            ->setScopes([Model\SubOAuth::SCOPES_ACCESS_REUSABLE_FORMS]);

        $customLogoFile = new SplFileObject("{$this->rootFilePath}/pdf-sample.pdf");

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
