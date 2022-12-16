<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TemplateApi($config);

$templateId = "5de8179668f2033afac48da1868d0093bf133266";
$fileType = "pdf";

try {
    $result = $api->templateFiles($templateId, $fileType);
    copy($result->getRealPath(), __DIR__ . '/file_response.pdf');
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}
