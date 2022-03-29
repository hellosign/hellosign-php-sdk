<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\ApiAppApi($config);

$oauth = new HelloSignSDK\Model\SubOAuth();
$oauth->setCallbackUrl("https://example.com/oauth")
    ->setScopes([
        HelloSignSDK\Model\SubOAuth::SCOPES_BASIC_ACCOUNT_INFO,
        HelloSignSDK\Model\SubOAuth::SCOPES_REQUEST_SIGNATURE,
    ]);

$whiteLabelingOptions = new HelloSignSDK\Model\SubWhiteLabelingOptions();
$whiteLabelingOptions->setPrimaryButtonColor("#00b3e6")
    ->setPrimaryButtonTextColor("#ffffff");

$customLogoFile = new SplFileObject(__DIR__ . "/CustomLogoFile.png");

$data = new HelloSignSDK\Model\ApiAppCreateRequest();
$data->setName("My Production App")
    ->setDomains(["example.com"])
    ->setOauth($oauth)
    ->setWhiteLabelingOptions($whiteLabelingOptions)
    ->setCustomLogoFile($customLogoFile);

try {
    $result = $api->apiAppCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
