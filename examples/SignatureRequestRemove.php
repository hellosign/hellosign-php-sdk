<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

$api = new HelloSignSDK\Api\SignatureRequestApi(
    new GuzzleHttp\Client(),
    $config
);

$signatureRequestId = "2f9781e1a8e2045224d808c153c2e1d3df6f8f2f";

try {
    $api->signatureRequestRemove($signatureRequestId);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
