<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signer1 = new HelloSignSDK\Model\SubSignatureRequestSigner();
$signer1->setEmailAddress("jack@example.com")
    ->setName("Jack")
    ->setOrder(0);

$signer2 = new HelloSignSDK\Model\SubSignatureRequestSigner();
$signer2->setEmailAddress("jill@example.com")
    ->setName("Jill")
    ->setOrder(1);

$signingOptions = new HelloSignSDK\Model\SubSigningOptions();
$signingOptions->setDraw(true)
    ->setType(true)
    ->setUpload(true)
    ->setPhone(true)
    ->setDefaultType(HelloSignSDK\Model\SubSigningOptions::DEFAULT_TYPE_DRAW);

$data = new HelloSignSDK\Model\SignatureRequestCreateEmbeddedRequest();
$data->setClientId("ec64a202072370a737edf4a0eb7f4437")
    ->setTitle("NDA with Acme Co.")
    ->setSubject("The NDA we talked about")
    ->setMessage("Please sign this NDA and then we can discuss more. Let me know if you have any questions.")
    ->setSigners([$signer1, $signer2])
    ->setCcEmailAddresses([
        "lawyer@hellosign.com",
        "lawyer@example.com",
    ])
    ->setFile([new SplFileObject(__DIR__ . "/example_signature_request.pdf")])
    ->setSigningOptions($signingOptions)
    ->setTestMode(true);

try {
    $result = $api->signatureRequestCreateEmbedded($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}
