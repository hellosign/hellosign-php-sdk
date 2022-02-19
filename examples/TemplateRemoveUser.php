<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TemplateApi(
    new GuzzleHttp\Client(),
    $config
);

$data = new HelloSignSDK\Model\TemplateRemoveUserRequest();
$data->setEmailAddress("george@hellosign.com");

$templateId = "21f920ec2b7f4b6bb64d3ed79f26303843046536";

try {
    $result = $api->templateRemoveUser($templateId, $data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
