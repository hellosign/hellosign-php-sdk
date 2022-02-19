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

$signer1 = new HelloSignSDK\Model\SubSignatureRequestTemplateSigner();
$signer1->setRole("Client")
    ->setEmailAddress("george@example.com")
    ->setName("George");

$cc1 = new HelloSignSDK\Model\SubCC();
$cc1->setRole("Accounting")
    ->setEmailAddress("accounting@example.com");

$customField1 = new HelloSignSDK\Model\SubCustomField();
$customField1->setName("Cost")
    ->setValue("$20,000")
    ->setEditor("Client")
    ->setRequired(true);

$signingOptions = new HelloSignSDK\Model\SubSigningOptions();
$signingOptions->setDraw(true)
    ->setType(true)
    ->setUpload(true)
    ->setPhone(false)
    ->setDefaultType(HelloSignSDK\Model\SubSigningOptions::DEFAULT_TYPE_DRAW);

$data = new HelloSignSDK\Model\SignatureRequestSendWithTemplateRequest();
$data->setTemplateIds(["c26b8a16784a872da37ea946b9ddec7c1e11dff6"])
    ->setSubject("Purchase Order")
    ->setMessage("Glad we could come to an agreement.")
    ->setSigners([$signer1])
    ->setCcs([$cc1])
    ->setCustomFields([$customField1])
    ->setSigningOptions($signingOptions)
    ->setTestMode(true);

try {
    $result = $api->signatureRequestSendWithTemplate($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
