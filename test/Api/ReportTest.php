<?php

namespace HelloSignSDK\Test\Api;

use GuzzleHttp;
use HelloSignSDK\Api;
use HelloSignSDK\Configuration;
use HelloSignSDK\Model;
use HelloSignSDK\Test\HelloTestCase;
use HelloSignSDK\Test\TestUtils;

class ReportTest extends HelloTestCase
{
    /** @var Api\ReportApi */
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new GuzzleHttp\Client([
            'handler' => GuzzleHttp\HandlerStack::create($this->handler),
        ]);

        $this->api = new Api\ReportApi(
            $this->client,
            Configuration::getDefaultConfiguration()
        );
    }

    public function testTokenGenerate()
    {
        $requestClass = Model\ReportCreateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\ReportCreateResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\ReportCreateRequest::fromArray($requestData);

        $response = $this->api->reportCreate($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }
}
