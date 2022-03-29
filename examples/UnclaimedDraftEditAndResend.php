<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\UnclaimedDraftApi($config);

$data = new HelloSignSDK\Model\UnclaimedDraftEditAndResendRequest();
$data->setClientId("ec64a202072370a737edf4a0eb7f4437")
    ->setTestMode(true);

$signatureRequestId = "2f9781e1a83jdja934d808c153c2e1d3df6f8f2f";

try {
    $result = $api->unclaimedDraftEditAndResend($signatureRequestId, $data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
