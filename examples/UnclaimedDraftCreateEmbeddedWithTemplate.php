<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\UnclaimedDraftApi($config);

$signer1 = new HelloSignSDK\Model\SubUnclaimedDraftTemplateSigner();
$signer1->setRole("Client")
    ->setName("George")
    ->setEmailAddress("george@example.com");

$cc1 = new HelloSignSDK\Model\SubCC();
$cc1->setRole("Accounting")
    ->setEmailAddress("accounting@hellosign.com");

$data = new HelloSignSDK\Model\UnclaimedDraftCreateEmbeddedWithTemplateRequest();
$data->setClientId("ec64a202072370a737edf4a0eb7f4437")
    ->setTemplateIds(["61a832ff0d8423f91d503e76bfbcc750f7417c78"])
    ->setRequesterEmailAddress("jack@hellosign.com")
    ->setSigners([$signer1])
    ->setCcs([$cc1])
    ->setTestMode(true);

try {
    $result = $api->unclaimedDraftCreateEmbeddedWithTemplate($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}
