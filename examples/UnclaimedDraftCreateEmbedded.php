<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\UnclaimedDraftApi(
    new GuzzleHttp\Client(),
    $config
);

$data = new HelloSignSDK\Model\UnclaimedDraftCreateEmbeddedRequest();
$data->setClientId("ec64a202072370a737edf4a0eb7f4437")
    ->setFileUrl(["https://app.hellosign.com/docs/example_signature_request.pdf"])
    ->setRequesterEmailAddress("jack@hellosign.com")
    ->setTestMode(true);

try {
    $result = $api->unclaimedDraftCreateEmbedded($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
