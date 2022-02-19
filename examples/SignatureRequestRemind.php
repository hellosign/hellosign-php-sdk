<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi(
    new GuzzleHttp\Client(),
    $config
);

$data = new HelloSignSDK\Model\SignatureRequestRemindRequest();
$data->setEmailAddress("john@example.com");

$signatureRequestId = "2f9781e1a8e2045224d808c153c2e1d3df6f8f2f";

try {
    $result = $api->signatureRequestRemind($signatureRequestId, $data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
