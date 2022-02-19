<?php

require_once __DIR__ . "/vendor/autoload.php";

$api = new HelloSignSDK\Api\OAuthApi(
    new GuzzleHttp\Client(),
    HelloSignSDK\Configuration::getDefaultConfiguration()
);

$data = new HelloSignSDK\Model\OAuthTokenRefreshRequest();
$data->setRefreshToken("hNTI2MTFmM2VmZDQxZTZjOWRmZmFjZmVmMGMyNGFjMzI2MGI5YzgzNmE3");

try {
    $result = $api->oauthTokenRefresh($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
