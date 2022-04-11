<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signerList1Signer = new HelloSignSDK\Model\SubSignatureRequestTemplateSigner();
$signerList1Signer->setRole("Client")
    ->setName("George")
    ->setEmailAddress("george@example.com")
    ->setPin("d79a3td");

$signerList1CustomFields = new HelloSignSDK\Model\SubBulkSignerListCustomField();
$signerList1CustomFields->setName("company")
    ->setValue("ABC Corp");

$signerList1 = new HelloSignSDK\Model\SubBulkSignerList();
$signerList1->setSigners([$signerList1Signer])
    ->setCustomFields([$signerList1CustomFields]);

$signerList2Signer = new HelloSignSDK\Model\SubSignatureRequestTemplateSigner();
$signerList2Signer->setRole("Client")
    ->setName("Mary")
    ->setEmailAddress("mary@example.com")
    ->setPin("gd9as5b");

$signerList2CustomFields = new HelloSignSDK\Model\SubBulkSignerListCustomField();
$signerList2CustomFields->setName("company")
    ->setValue("123 LLC");

$signerList2 = new HelloSignSDK\Model\SubBulkSignerList();
$signerList2->setSigners([$signerList2Signer])
    ->setCustomFields([$signerList2CustomFields]);

$cc1 = new HelloSignSDK\Model\SubCC();
$cc1->setRole("Accounting")
    ->setEmailAddress("accounting@example.com");

$data = new HelloSignSDK\Model\SignatureRequestBulkSendWithTemplateRequest();
$data->setClientId("ec64a202072370a737edf4a0eb7f4437")
    ->setTemplateIds(["c26b8a16784a872da37ea946b9ddec7c1e11dff6"])
    ->setSubject("Purchase Order")
    ->setMessage("Glad we could come to an agreement.")
    ->setSignerList([$signerList1, $signerList2])
    ->setCcs([$cc1])
    ->setTestMode(true);

try {
    $result = $api->signatureRequestBulkSendWithTemplate($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
