<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TemplateApi($config);

$role1 = new HelloSignSDK\Model\SubTemplateRole();
$role1->setName("Client")
    ->setOrder(0);

$role2 = new HelloSignSDK\Model\SubTemplateRole();
$role2->setName("Witness")
    ->setOrder(1);

$mergeField1 = new HelloSignSDK\Model\SubMergeField();
$mergeField1->setName("Full Name")
    ->setType(HelloSignSDK\Model\SubMergeField::TYPE_TEXT);

$mergeField2 = new HelloSignSDK\Model\SubMergeField();
$mergeField2->setName("Is Registered?")
    ->setType(HelloSignSDK\Model\SubMergeField::TYPE_CHECKBOX);

$fieldOptions = new HelloSignSDK\Model\SubFieldOptions();
$fieldOptions->setDateFormat(HelloSignSDK\Model\SubFieldOptions::DATE_FORMAT_DD_MM_YYYY);

$data = new HelloSignSDK\Model\TemplateCreateEmbeddedDraftRequest();
$data->setClientId("37dee8d8440c66d54cfa05d92c160882")
    ->setFile([new SplFileObject(__DIR__ . "/example_signature_request.pdf")])
    ->setTitle("Test Template")
    ->setSubject("Please sign this document")
    ->setMessage("For your approval")
    ->setSignerRoles([$role1, $role2])
    ->setCcRoles(["Manager"])
    ->setMergeFields([$mergeField1, $mergeField2])
    ->setFieldOptions($fieldOptions)
    ->setTestMode(true);

try {
    $result = $api->templateCreateEmbeddedDraft($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}
