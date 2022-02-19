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

$accountId = null;
$page = 1;

try {
    $result = $api->signatureRequestList($accountId, $page);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
