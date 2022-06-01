<?php

require_once __DIR__ . "/vendor/autoload.php";

$api = new HelloSignSDK\Api\OAuthApi(
    HelloSignSDK\Configuration::getDefaultConfiguration()
);

$data = new HelloSignSDK\Model\OAuthTokenRefreshRequest();
$data->setRefreshToken("hNTI2MTFmM2VmZDQxZTZjOWRmZmFjZmVmMGMyNGFjMzI2MGI5YzgzNmE3");

try {
    $result = $api->oauthTokenRefresh($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}
