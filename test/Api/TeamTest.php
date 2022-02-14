<?php

namespace HelloSignSDK\Test\Api;

use GuzzleHttp;
use HelloSignSDK\Api;
use HelloSignSDK\Configuration;
use HelloSignSDK\Model;
use HelloSignSDK\Test\HelloTestCase;
use HelloSignSDK\Test\TestUtils;

class TeamTest extends HelloTestCase
{
    /** @var Api\TeamApi */
    protected $api;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new GuzzleHttp\Client([
            'handler' => GuzzleHttp\HandlerStack::create($this->handler),
        ]);

        $this->api = new Api\TeamApi(
            $this->client,
            Configuration::getDefaultConfiguration()
        );
    }

    public function testTeamAddMember()
    {
        $requestClass = Model\TeamAddMemberRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\TeamGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\TeamAddMemberRequest::fromArray($requestData);

        $response = $this->api->teamAddMember($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testTeamCreate()
    {
        $requestClass = Model\TeamCreateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\TeamGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\TeamCreateRequest::fromArray($requestData);

        $response = $this->api->teamCreate($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testTeamDelete()
    {
        $this->markTestSkipped('DELETE /team/destroy skipped');
    }

    public function testTeamGet()
    {
        $responseClass = Model\TeamGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $response = $this->api->teamGet();
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testTeamUpdate()
    {
        $requestClass = Model\TeamUpdateRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\TeamGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\TeamUpdateRequest::fromArray($requestData);

        $response = $this->api->teamUpdate($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }

    public function testTeamRemoveMember()
    {
        $requestClass = Model\TeamRemoveMemberRequest::class;
        $requestData = TestUtils::getFixtureData($requestClass)['default'];

        $responseClass = Model\TeamGetResponse::class;
        $responseData = TestUtils::getFixtureData($responseClass)['default'];

        $this->setExpectedResponse($responseData);

        $obj = Model\TeamRemoveMemberRequest::fromArray($requestData);

        $response = $this->api->teamRemoveMember($obj);
        $serialized = TestUtils::removeRootPathFromFiles(TestUtils::toArray($response));

        $this->assertInstanceOf($responseClass, $response);
        $this->assertEquals($responseData, $serialized);
        $this->assertEquals($responseData, TestUtils::toArray($response));
    }
}
