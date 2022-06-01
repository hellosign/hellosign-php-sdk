<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TemplateApi($config);

$data = new HelloSignSDK\Model\TemplateAddUserRequest();
$data->setEmailAddress("george@hellosign.com");

$templateId = "f57db65d3f933b5316d398057a36176831451a35";

try {
    $result = $api->templateAddUser($templateId, $data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}
