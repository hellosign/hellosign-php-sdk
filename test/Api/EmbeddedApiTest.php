<?php

declare(strict_types=1);

namespace HelloSignSDK\Test\Api;

use GuzzleHttp;
use HelloSignSDK\Api;
use HelloSignSDK\Configuration;
use HelloSignSDK\Model;
use HelloSignSDK\Test\HelloTestCase;
use HelloSignSDK\Test\TestUtils;

class EmbeddedApiTest extends HelloTestCase
{
    /** @var Api\EmbeddedApi */
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new GuzzleHttp\Client([
            'handler' => GuzzleHttp\HandlerStack::create($this->handler),
        ]);

        $this->api = new Api\EmbeddedApi(
            Configuration::getDefaultConfiguration(),
            $this->client,
        );
    }

    public function testEmbeddedEditUrl()
    {
        $templateId = '5de8179668f2033afac48da1868d0093bf133266';

        $requestClass = Model\EmbeddedEditUrlRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\EmbeddedEditUrlResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\EmbeddedEditUrlRequest::fromArray($requestData);

        $response = $this->api->embeddedEditUrl($templateId, $obj);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testEmbeddedSignUrl()
    {
        $signatureId = '50e3542f738adfa7ddd4cbd4c00d2a8ab6e4194b';

        $responseClass = Model\EmbeddedSignUrlResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $response = $this->api->embeddedSignUrl($signatureId);
        $serialized = TestUtils::toArray($response);

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }
}
