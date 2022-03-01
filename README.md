# hellosign/openapi-php-sdk

HelloSign v3 API


## ⚠ This package is not yet ready for production use ⚠

We are working hard on getting this package ready, but it is not there, yet!

You should think twice before using package on anything critical.

The interfaces may change without warning. Backwards compatibility is not yet
guaranteed nor implied!

## Contributing

### Submodule

This repo uses the [hellosign/openapi](https://github.com/hellosign/openapi) repo
as a submodule for its OAS source. When you first clone this repo you must also
instantiate the submodule by running the following:

```shell
git submodule init
git submodule update
```

### Changes to the OAS

You must make OAS changes in the `oas/openapi.yaml` file within the
[hellosign/openapi](https://github.com/hellosign/openapi) submodule.

### Changes to the SDK code

You must make SDK code changes in the mustache file within the `templates`
directory that corresponds to the file you want updated.

We use [OpenAPI Generator](https://openapi-generator.tech/) to automatically
generate this SDK from the OAS, using the template files.

### Building

You must have `docker` (or `podman` linked to `docker`) installed. Highly
recommended to use
[rootless docker](https://docs.docker.com/engine/security/rootless/).

Run the following and everything is done for you:

```shell
./build
```

*Attention*: Any changes you have made to the SDK code that you have not made
to the OAS file and/or the mustache template files _will be lost_ when you run
this command.

## Installation & Usage

### Requirements

PHP 7.3 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
    "require": {
        "hellosign/openapi-php-sdk": "^4.0"
    }
}
```

Then run `composer install`.

Alternatively, install directly with

```
composer require hellosign/openapi-php-sdk:^4.0
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:


```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\AccountApi(
    new GuzzleHttp\Client(),
    $config
);

$data = new HelloSignSDK\Model\AccountCreateRequest();
$data->setEmailAddress("newuser@hellosign.com");

try {
    $result = $api->accountCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

You may also instantiate objects by calling the class' `fromArray()` method:

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();
$config->setUsername("YOUR_API_KEY");

$api = new HelloSignSDK\Api\SignatureRequestApi(
    new GuzzleHttp\Client(),
    $config
);

$data = HelloSignSDK\Model\SignatureRequestSendRequest::fromArray([
    "title"   => "NDA with Acme Co.",
    "signers" => [
        [
            "email_address" => "jack@example.com",
            "name"          => "Jack",
            "order"         => 0,
        ],
        [
            "email_address" => "jill@example.com",
            "name"          => "Jill",
            "order"         => 1,
        ],
    ],
    "file"    => [
        "/absolute/path/to/file.pdf",
    ],
]);

try {
    $result = $api->signatureRequestSend($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}
```

## API Endpoints

All URIs are relative to *https://api.hellosign.com/v3*

| Class      | Method        | HTTP request  | Description   |
| ---------- | ------------- | ------------- | ------------- |
| *AccountApi* | [**accountCreate**](docs/Api/AccountApi.md#accountcreate) | **POST** /account/create | Signs up for a new HelloSign Account. |
| *AccountApi* | [**accountGet**](docs/Api/AccountApi.md#accountget) | **GET** /account | Returns your Account settings. |
| *AccountApi* | [**accountUpdate**](docs/Api/AccountApi.md#accountupdate) | **PUT** /account | Updates your Account&#39;s settings. |
| *AccountApi* | [**accountVerify**](docs/Api/AccountApi.md#accountverify) | **POST** /account/verify | Verify whether a HelloSign Account exists. |
| *ApiAppApi* | [**apiAppCreate**](docs/Api/ApiAppApi.md#apiappcreate) | **POST** /api_app | Creates a new API App. |
| *ApiAppApi* | [**apiAppDelete**](docs/Api/ApiAppApi.md#apiappdelete) | **DELETE** /api_app/{client_id} | Deletes an API App. |
| *ApiAppApi* | [**apiAppGet**](docs/Api/ApiAppApi.md#apiappget) | **GET** /api_app/{client_id} | Gets an API App. |
| *ApiAppApi* | [**apiAppList**](docs/Api/ApiAppApi.md#apiapplist) | **GET** /api_app/list | Lists your API Apps. |
| *ApiAppApi* | [**apiAppUpdate**](docs/Api/ApiAppApi.md#apiappupdate) | **PUT** /api_app/{client_id} | Updates an existing API App. |
| *BulkSendJobApi* | [**bulkSendJobGet**](docs/Api/BulkSendJobApi.md#bulksendjobget) | **GET** /bulk_send_job/{bulk_send_job_id} | Gets a BulkSendJob that includes all SignatureRequests it has sent. |
| *BulkSendJobApi* | [**bulkSendJobList**](docs/Api/BulkSendJobApi.md#bulksendjoblist) | **GET** /bulk_send_job/list | Lists the BulkSendJob that you have access to. |
| *EmbeddedApi* | [**embeddedEditUrl**](docs/Api/EmbeddedApi.md#embeddedediturl) | **POST** /embedded/edit_url/{template_id} | Retrieves an embedded template object. |
| *EmbeddedApi* | [**embeddedSignUrl**](docs/Api/EmbeddedApi.md#embeddedsignurl) | **GET** /embedded/sign_url/{signature_id} | Retrieves an embedded signing object. |
| *OAuthApi* | [**oauthTokenGenerate**](docs/Api/OAuthApi.md#oauthtokengenerate) | **POST** /oauth/token | OAuth Token Generate |
| *OAuthApi* | [**oauthTokenRefresh**](docs/Api/OAuthApi.md#oauthtokenrefresh) | **POST** /oauth/token?refresh | OAuth Token Refresh |
| *ReportApi* | [**reportCreate**](docs/Api/ReportApi.md#reportcreate) | **POST** /report/create | Creates one or more report(s). |
| *SignatureRequestApi* | [**signatureRequestBulkCreateEmbeddedWithTemplate**](docs/Api/SignatureRequestApi.md#signaturerequestbulkcreateembeddedwithtemplate) | **POST** /signature_request/bulk_create_embedded_with_template | Creates BulkSendJob which sends SignatureRequests in bulk based off of the provided Template(s) to be signed in an embedded window. |
| *SignatureRequestApi* | [**signatureRequestBulkSendWithTemplate**](docs/Api/SignatureRequestApi.md#signaturerequestbulksendwithtemplate) | **POST** /signature_request/bulk_send_with_template | Creates BulkSendJob which sends SignatureRequests in bulk based off of the provided Template(s). |
| *SignatureRequestApi* | [**signatureRequestCancel**](docs/Api/SignatureRequestApi.md#signaturerequestcancel) | **POST** /signature_request/cancel/{signature_request_id} | Cancels an incomplete SignatureRequest. |
| *SignatureRequestApi* | [**signatureRequestCreateEmbedded**](docs/Api/SignatureRequestApi.md#signaturerequestcreateembedded) | **POST** /signature_request/create_embedded | Creates a new SignatureRequest to be signed in an embedded window. |
| *SignatureRequestApi* | [**signatureRequestCreateEmbeddedWithTemplate**](docs/Api/SignatureRequestApi.md#signaturerequestcreateembeddedwithtemplate) | **POST** /signature_request/create_embedded_with_template | Creates and sends a new SignatureRequest based off of the provided Template(s). |
| *SignatureRequestApi* | [**signatureRequestFiles**](docs/Api/SignatureRequestApi.md#signaturerequestfiles) | **GET** /signature_request/files/{signature_request_id} | Obtain a copy of the current documents. |
| *SignatureRequestApi* | [**signatureRequestGet**](docs/Api/SignatureRequestApi.md#signaturerequestget) | **GET** /signature_request/{signature_request_id} | Gets a SignatureRequest that includes the current status for each signer. |
| *SignatureRequestApi* | [**signatureRequestList**](docs/Api/SignatureRequestApi.md#signaturerequestlist) | **GET** /signature_request/list | Lists the SignatureRequests (both inbound and outbound) that you have access to. |
| *SignatureRequestApi* | [**signatureRequestReleaseHold**](docs/Api/SignatureRequestApi.md#signaturerequestreleasehold) | **POST** /signature_request/release_hold/{signature_request_id} | Releases a SignatureRequest from hold. |
| *SignatureRequestApi* | [**signatureRequestRemind**](docs/Api/SignatureRequestApi.md#signaturerequestremind) | **POST** /signature_request/remind/{signature_request_id} | Sends an email to the signer reminding them to sign the signature request. |
| *SignatureRequestApi* | [**signatureRequestRemove**](docs/Api/SignatureRequestApi.md#signaturerequestremove) | **POST** /signature_request/remove/{signature_request_id} | Remove access to a completed SignatureRequest. |
| *SignatureRequestApi* | [**signatureRequestSend**](docs/Api/SignatureRequestApi.md#signaturerequestsend) | **POST** /signature_request/send | Creates and sends a new SignatureRequest with the submitted documents. |
| *SignatureRequestApi* | [**signatureRequestSendWithTemplate**](docs/Api/SignatureRequestApi.md#signaturerequestsendwithtemplate) | **POST** /signature_request/send_with_template | Creates and sends a new SignatureRequest based off of one or more Templates. |
| *SignatureRequestApi* | [**signatureRequestUpdate**](docs/Api/SignatureRequestApi.md#signaturerequestupdate) | **POST** /signature_request/update/{signature_request_id} | Update an email address on a signature request. |
| *TeamApi* | [**teamAddMember**](docs/Api/TeamApi.md#teamaddmember) | **PUT** /team/add_member | Adds or invites a user to your Team. |
| *TeamApi* | [**teamCreate**](docs/Api/TeamApi.md#teamcreate) | **POST** /team/create | Creates a new Team. |
| *TeamApi* | [**teamDelete**](docs/Api/TeamApi.md#teamdelete) | **DELETE** /team/destroy | Deletes your Team. |
| *TeamApi* | [**teamGet**](docs/Api/TeamApi.md#teamget) | **GET** /team | Gets your Team and a list of its members. |
| *TeamApi* | [**teamRemoveMember**](docs/Api/TeamApi.md#teamremovemember) | **POST** /team/remove_member | Removes a user from your Team. |
| *TeamApi* | [**teamUpdate**](docs/Api/TeamApi.md#teamupdate) | **PUT** /team | Updates a Team&#39;s name. |
| *TemplateApi* | [**templateAddUser**](docs/Api/TemplateApi.md#templateadduser) | **POST** /template/add_user/{template_id} | Gives the specified Account access to the specified Template. |
| *TemplateApi* | [**templateCreateEmbeddedDraft**](docs/Api/TemplateApi.md#templatecreateembeddeddraft) | **POST** /template/create_embedded_draft | Creates an embedded template draft for further editing. |
| *TemplateApi* | [**templateDelete**](docs/Api/TemplateApi.md#templatedelete) | **POST** /template/delete/{template_id} | Deletes the specified template. |
| *TemplateApi* | [**templateFiles**](docs/Api/TemplateApi.md#templatefiles) | **GET** /template/files/{template_id} | Obtain a copy of a template&#39;s original files. |
| *TemplateApi* | [**templateGet**](docs/Api/TemplateApi.md#templateget) | **GET** /template/{template_id} | Gets a Template which includes a list of Accounts that can access it. |
| *TemplateApi* | [**templateList**](docs/Api/TemplateApi.md#templatelist) | **GET** /template/list | Lists your Templates. |
| *TemplateApi* | [**templateRemoveUser**](docs/Api/TemplateApi.md#templateremoveuser) | **POST** /template/remove_user/{template_id} | Removes the specified Account&#39;s access to the specified Template. |
| *TemplateApi* | [**templateUpdateFiles**](docs/Api/TemplateApi.md#templateupdatefiles) | **POST** /template/update_files/{template_id} | Overlays a new file with the overlay of an existing template. |
| *UnclaimedDraftApi* | [**unclaimedDraftCreate**](docs/Api/UnclaimedDraftApi.md#unclaimeddraftcreate) | **POST** /unclaimed_draft/create | Creates a new Draft that can be claimed using the claim URL. |
| *UnclaimedDraftApi* | [**unclaimedDraftCreateEmbedded**](docs/Api/UnclaimedDraftApi.md#unclaimeddraftcreateembedded) | **POST** /unclaimed_draft/create_embedded | Creates a new Draft that will be claimed for use in an embedded iFrame. |
| *UnclaimedDraftApi* | [**unclaimedDraftCreateEmbeddedWithTemplate**](docs/Api/UnclaimedDraftApi.md#unclaimeddraftcreateembeddedwithtemplate) | **POST** /unclaimed_draft/create_embedded_with_template | Creates a new Draft using existing template(s) that will be claimed for use in an embedded iFrame. |
| *UnclaimedDraftApi* | [**unclaimedDraftEditAndResend**](docs/Api/UnclaimedDraftApi.md#unclaimeddrafteditandresend) | **POST** /unclaimed_draft/edit_and_resend/{signature_request_id} | Creates a new signature request from an embedded request that can be edited prior to being sent. |

## Models

- [AccountCreateRequest](docs/Model/AccountCreateRequest.md)
- [AccountCreateResponse](docs/Model/AccountCreateResponse.md)
- [AccountGetResponse](docs/Model/AccountGetResponse.md)
- [AccountResponse](docs/Model/AccountResponse.md)
- [AccountResponseQuotas](docs/Model/AccountResponseQuotas.md)
- [AccountUpdateRequest](docs/Model/AccountUpdateRequest.md)
- [AccountVerifyRequest](docs/Model/AccountVerifyRequest.md)
- [AccountVerifyResponse](docs/Model/AccountVerifyResponse.md)
- [AccountVerifyResponseAccount](docs/Model/AccountVerifyResponseAccount.md)
- [ApiAppCreateRequest](docs/Model/ApiAppCreateRequest.md)
- [ApiAppGetResponse](docs/Model/ApiAppGetResponse.md)
- [ApiAppListResponse](docs/Model/ApiAppListResponse.md)
- [ApiAppResponse](docs/Model/ApiAppResponse.md)
- [ApiAppResponseOAuth](docs/Model/ApiAppResponseOAuth.md)
- [ApiAppResponseOptions](docs/Model/ApiAppResponseOptions.md)
- [ApiAppResponseOwnerAccount](docs/Model/ApiAppResponseOwnerAccount.md)
- [ApiAppResponseWhiteLabelingOptions](docs/Model/ApiAppResponseWhiteLabelingOptions.md)
- [ApiAppUpdateRequest](docs/Model/ApiAppUpdateRequest.md)
- [BulkSendJobGetResponse](docs/Model/BulkSendJobGetResponse.md)
- [BulkSendJobGetResponseSignatureRequests](docs/Model/BulkSendJobGetResponseSignatureRequests.md)
- [BulkSendJobListResponse](docs/Model/BulkSendJobListResponse.md)
- [BulkSendJobResponse](docs/Model/BulkSendJobResponse.md)
- [BulkSendJobSendResponse](docs/Model/BulkSendJobSendResponse.md)
- [EmbeddedEditUrlRequest](docs/Model/EmbeddedEditUrlRequest.md)
- [EmbeddedEditUrlResponse](docs/Model/EmbeddedEditUrlResponse.md)
- [EmbeddedEditUrlResponseEmbedded](docs/Model/EmbeddedEditUrlResponseEmbedded.md)
- [EmbeddedSignUrlResponse](docs/Model/EmbeddedSignUrlResponse.md)
- [EmbeddedSignUrlResponseEmbedded](docs/Model/EmbeddedSignUrlResponseEmbedded.md)
- [ErrorResponse](docs/Model/ErrorResponse.md)
- [EventCallbackAccountRequest](docs/Model/EventCallbackAccountRequest.md)
- [EventCallbackAccountRequestPayload](docs/Model/EventCallbackAccountRequestPayload.md)
- [EventCallbackApiAppRequest](docs/Model/EventCallbackApiAppRequest.md)
- [EventCallbackApiAppRequestPayload](docs/Model/EventCallbackApiAppRequestPayload.md)
- [EventCallbackRequestEvent](docs/Model/EventCallbackRequestEvent.md)
- [EventCallbackRequestEventMetadata](docs/Model/EventCallbackRequestEventMetadata.md)
- [FileResponse](docs/Model/FileResponse.md)
- [ListInfoResponse](docs/Model/ListInfoResponse.md)
- [OAuthTokenGenerateRequest](docs/Model/OAuthTokenGenerateRequest.md)
- [OAuthTokenRefreshRequest](docs/Model/OAuthTokenRefreshRequest.md)
- [OAuthTokenResponse](docs/Model/OAuthTokenResponse.md)
- [ReportCreateRequest](docs/Model/ReportCreateRequest.md)
- [ReportCreateResponse](docs/Model/ReportCreateResponse.md)
- [ReportResponse](docs/Model/ReportResponse.md)
- [SignatureRequestBulkCreateEmbeddedWithTemplateRequest](docs/Model/SignatureRequestBulkCreateEmbeddedWithTemplateRequest.md)
- [SignatureRequestBulkSendWithTemplateRequest](docs/Model/SignatureRequestBulkSendWithTemplateRequest.md)
- [SignatureRequestCreateEmbeddedRequest](docs/Model/SignatureRequestCreateEmbeddedRequest.md)
- [SignatureRequestCreateEmbeddedWithTemplateRequest](docs/Model/SignatureRequestCreateEmbeddedWithTemplateRequest.md)
- [SignatureRequestGetResponse](docs/Model/SignatureRequestGetResponse.md)
- [SignatureRequestListResponse](docs/Model/SignatureRequestListResponse.md)
- [SignatureRequestRemindRequest](docs/Model/SignatureRequestRemindRequest.md)
- [SignatureRequestResponse](docs/Model/SignatureRequestResponse.md)
- [SignatureRequestResponseCustomField](docs/Model/SignatureRequestResponseCustomField.md)
- [SignatureRequestResponseData](docs/Model/SignatureRequestResponseData.md)
- [SignatureRequestResponseSignatures](docs/Model/SignatureRequestResponseSignatures.md)
- [SignatureRequestSendRequest](docs/Model/SignatureRequestSendRequest.md)
- [SignatureRequestSendWithTemplateRequest](docs/Model/SignatureRequestSendWithTemplateRequest.md)
- [SignatureRequestUpdateRequest](docs/Model/SignatureRequestUpdateRequest.md)
- [SubAttachment](docs/Model/SubAttachment.md)
- [SubBulkSignerList](docs/Model/SubBulkSignerList.md)
- [SubBulkSignerListCustomField](docs/Model/SubBulkSignerListCustomField.md)
- [SubBulkSignerListSigner](docs/Model/SubBulkSignerListSigner.md)
- [SubCC](docs/Model/SubCC.md)
- [SubCustomField](docs/Model/SubCustomField.md)
- [SubEditorOptions](docs/Model/SubEditorOptions.md)
- [SubFieldOptions](docs/Model/SubFieldOptions.md)
- [SubFormFieldGroup](docs/Model/SubFormFieldGroup.md)
- [SubFormFieldRule](docs/Model/SubFormFieldRule.md)
- [SubFormFieldRuleAction](docs/Model/SubFormFieldRuleAction.md)
- [SubFormFieldRuleTrigger](docs/Model/SubFormFieldRuleTrigger.md)
- [SubFormFieldsPerDocumentBase](docs/Model/SubFormFieldsPerDocumentBase.md)
- [SubFormFieldsPerDocumentCheckbox](docs/Model/SubFormFieldsPerDocumentCheckbox.md)
- [SubFormFieldsPerDocumentCheckboxMerge](docs/Model/SubFormFieldsPerDocumentCheckboxMerge.md)
- [SubFormFieldsPerDocumentDateSigned](docs/Model/SubFormFieldsPerDocumentDateSigned.md)
- [SubFormFieldsPerDocumentDropdown](docs/Model/SubFormFieldsPerDocumentDropdown.md)
- [SubFormFieldsPerDocumentHyperlink](docs/Model/SubFormFieldsPerDocumentHyperlink.md)
- [SubFormFieldsPerDocumentInitials](docs/Model/SubFormFieldsPerDocumentInitials.md)
- [SubFormFieldsPerDocumentRadio](docs/Model/SubFormFieldsPerDocumentRadio.md)
- [SubFormFieldsPerDocumentSignature](docs/Model/SubFormFieldsPerDocumentSignature.md)
- [SubFormFieldsPerDocumentText](docs/Model/SubFormFieldsPerDocumentText.md)
- [SubFormFieldsPerDocumentTextMerge](docs/Model/SubFormFieldsPerDocumentTextMerge.md)
- [SubFormFieldsPerDocumentTypeEnum](docs/Model/SubFormFieldsPerDocumentTypeEnum.md)
- [SubMergeField](docs/Model/SubMergeField.md)
- [SubOAuth](docs/Model/SubOAuth.md)
- [SubOptions](docs/Model/SubOptions.md)
- [SubSignatureRequestEmbeddedSigner](docs/Model/SubSignatureRequestEmbeddedSigner.md)
- [SubSignatureRequestEmbeddedTemplateSigner](docs/Model/SubSignatureRequestEmbeddedTemplateSigner.md)
- [SubSignatureRequestSigner](docs/Model/SubSignatureRequestSigner.md)
- [SubSignatureRequestTemplateSigner](docs/Model/SubSignatureRequestTemplateSigner.md)
- [SubSigningOptions](docs/Model/SubSigningOptions.md)
- [SubTemplateRole](docs/Model/SubTemplateRole.md)
- [SubUnclaimedDraftEmbeddedSigner](docs/Model/SubUnclaimedDraftEmbeddedSigner.md)
- [SubUnclaimedDraftEmbeddedTemplateSigner](docs/Model/SubUnclaimedDraftEmbeddedTemplateSigner.md)
- [SubUnclaimedDraftSigner](docs/Model/SubUnclaimedDraftSigner.md)
- [SubWhiteLabelingOptions](docs/Model/SubWhiteLabelingOptions.md)
- [TeamAddMemberRequest](docs/Model/TeamAddMemberRequest.md)
- [TeamCreateRequest](docs/Model/TeamCreateRequest.md)
- [TeamGetResponse](docs/Model/TeamGetResponse.md)
- [TeamRemoveMemberRequest](docs/Model/TeamRemoveMemberRequest.md)
- [TeamResponse](docs/Model/TeamResponse.md)
- [TeamUpdateRequest](docs/Model/TeamUpdateRequest.md)
- [TemplateAddUserRequest](docs/Model/TemplateAddUserRequest.md)
- [TemplateCreateEmbeddedDraftRequest](docs/Model/TemplateCreateEmbeddedDraftRequest.md)
- [TemplateCreateEmbeddedDraftResponse](docs/Model/TemplateCreateEmbeddedDraftResponse.md)
- [TemplateCreateEmbeddedDraftResponseTemplate](docs/Model/TemplateCreateEmbeddedDraftResponseTemplate.md)
- [TemplateEditResponse](docs/Model/TemplateEditResponse.md)
- [TemplateGetResponse](docs/Model/TemplateGetResponse.md)
- [TemplateListResponse](docs/Model/TemplateListResponse.md)
- [TemplateRemoveUserRequest](docs/Model/TemplateRemoveUserRequest.md)
- [TemplateResponse](docs/Model/TemplateResponse.md)
- [TemplateResponseAccount](docs/Model/TemplateResponseAccount.md)
- [TemplateResponseAccountQuota](docs/Model/TemplateResponseAccountQuota.md)
- [TemplateResponseCCRole](docs/Model/TemplateResponseCCRole.md)
- [TemplateResponseCustomField](docs/Model/TemplateResponseCustomField.md)
- [TemplateResponseDocument](docs/Model/TemplateResponseDocument.md)
- [TemplateResponseDocumentCustomField](docs/Model/TemplateResponseDocumentCustomField.md)
- [TemplateResponseDocumentCustomFieldAvgTextLength](docs/Model/TemplateResponseDocumentCustomFieldAvgTextLength.md)
- [TemplateResponseDocumentFieldGroup](docs/Model/TemplateResponseDocumentFieldGroup.md)
- [TemplateResponseDocumentFormField](docs/Model/TemplateResponseDocumentFormField.md)
- [TemplateResponseSignerRole](docs/Model/TemplateResponseSignerRole.md)
- [TemplateUpdateFilesRequest](docs/Model/TemplateUpdateFilesRequest.md)
- [TemplateUpdateFilesResponse](docs/Model/TemplateUpdateFilesResponse.md)
- [TemplateUpdateFilesResponseTemplate](docs/Model/TemplateUpdateFilesResponseTemplate.md)
- [UnclaimedDraftCreateEmbeddedRequest](docs/Model/UnclaimedDraftCreateEmbeddedRequest.md)
- [UnclaimedDraftCreateEmbeddedWithTemplateRequest](docs/Model/UnclaimedDraftCreateEmbeddedWithTemplateRequest.md)
- [UnclaimedDraftCreateRequest](docs/Model/UnclaimedDraftCreateRequest.md)
- [UnclaimedDraftCreateResponse](docs/Model/UnclaimedDraftCreateResponse.md)
- [UnclaimedDraftEditAndResendRequest](docs/Model/UnclaimedDraftEditAndResendRequest.md)
- [UnclaimedDraftResponse](docs/Model/UnclaimedDraftResponse.md)
- [WarningResponse](docs/Model/WarningResponse.md)

## Authorization

### api_key

- **Type**: HTTP basic authentication


### oauth2

- **Type**: Bearer authentication (JWT)

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

apisupport@hellosign.com

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `3.0.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
