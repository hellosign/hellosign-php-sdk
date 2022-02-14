<?php

namespace HelloSignSDK\Test\Api;

use GuzzleHttp;
use HelloSignSDK\Api;
use HelloSignSDK\Configuration;
use HelloSignSDK\Model;
use HelloSignSDK\Test\HelloTestCase;
use HelloSignSDK\Test\TestUtils;

class OAuthTest extends HelloTestCase
{
    /** @var Api\OAuthApi */
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new GuzzleHttp\Client([
            'handler' => GuzzleHttp\HandlerStack::create($this->handler),
        ]);

        $this->api = new Api\OAuthApi(
            $this->client,
            Configuration::getDefaultConfiguration()
        );
    }

    public function testTokenGenerate()
    {
        $requestClass = Model\OAuthTokenGenerateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\OAuthTokenResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\OAuthTokenGenerateRequest::fromArray($requestData);

        $response = $this->api->oauthTokenGenerate($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testTokenRefresh()
    {
        $requestClass = Model\OAuthTokenRefreshRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\OAuthTokenResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['refresh'];

        $this->setExpectedResponse($responseData);

        $obj = Model\OAuthTokenRefreshRequest::fromArray($requestData);

        $response = $this->api->oauthTokenRefresh($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }
}
