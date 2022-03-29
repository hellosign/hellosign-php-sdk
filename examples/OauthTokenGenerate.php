<?php

require_once __DIR__ . "/vendor/autoload.php";

$api = new HelloSignSDK\Api\OAuthApi(
    HelloSignSDK\Configuration::getDefaultConfiguration()
);

$data = new HelloSignSDK\Model\OAuthTokenGenerateRequest();
$data->setState("900e06e2")
    ->setCode("1b0d28d90c86c141")
    ->setClientId("cc91c61d00f8bb2ece1428035716b")
    ->setClientSecret("1d14434088507ffa390e6f5528465");

try {
    $result = $api->oauthTokenGenerate($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
