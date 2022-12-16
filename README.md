# hellosign/hellosign-php-sdk

Dropbox Sign v3 API


## ⚠ This package is not yet ready for production use ⚠

We are working hard on getting this package ready, but it is not there, yet!

You should think twice before using package on anything critical.

The interfaces may change without warning. Backwards compatibility is not yet
guaranteed nor implied!

## Contributing

This repo is no longer accepting new issues or Pull Requests. All issues or
Pull Requests *must* be opened against the
[hellosign/hellosign-openapi](https://github.com/hellosign/hellosign-openapi) repo!

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
./run-build
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
        "hellosign/hellosign-php-sdk": "^6.0.0"
    },
    "minimum-stability": "dev"
}
```

Then run `composer install`.

Alternatively, install directly with

```
composer require hellosign/hellosign-php-sdk:^6.0.0
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

$api = new HelloSignSDK\Api\AccountApi($config);

$data = new HelloSignSDK\Model\AccountCreateRequest();
$data->setEmailAddress("newuser@hellosign.com");

try {
    $result = $api->accountCreate($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

You may also instantiate objects by calling the class' `fromArray()` method:

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();
$config->setUsername("YOUR_API_KEY");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

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
        new SplFileObject("/absolute/path/to/file.pdf"),
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
| *AccountApi* | [**accountCreate**](docs/Api/AccountApi.md#accountcreate) | **POST** /account/create | Create Account |
| *AccountApi* | [**accountGet**](docs/Api/AccountApi.md#accountget) | **GET** /account | Get Account |
| *AccountApi* | [**accountUpdate**](docs/Api/AccountApi.md#accountupdate) | **PUT** /account | Update Account |
| *AccountApi* | [**accountVerify**](docs/Api/AccountApi.md#accountverify) | **POST** /account/verify | Verify Account |
| *ApiAppApi* | [**apiAppCreate**](docs/Api/ApiAppApi.md#apiappcreate) | **POST** /api_app | Create API App |
| *ApiAppApi* | [**apiAppDelete**](docs/Api/ApiAppApi.md#apiappdelete) | **DELETE** /api_app/{client_id} | Delete API App |
| *ApiAppApi* | [**apiAppGet**](docs/Api/ApiAppApi.md#apiappget) | **GET** /api_app/{client_id} | Get API App |
| *ApiAppApi* | [**apiAppList**](docs/Api/ApiAppApi.md#apiapplist) | **GET** /api_app/list | List API Apps |
| *ApiAppApi* | [**apiAppUpdate**](docs/Api/ApiAppApi.md#apiappupdate) | **PUT** /api_app/{client_id} | Update API App |
| *BulkSendJobApi* | [**bulkSendJobGet**](docs/Api/BulkSendJobApi.md#bulksendjobget) | **GET** /bulk_send_job/{bulk_send_job_id} | Get Bulk Send Job |
| *BulkSendJobApi* | [**bulkSendJobList**](docs/Api/BulkSendJobApi.md#bulksendjoblist) | **GET** /bulk_send_job/list | List Bulk Send Jobs |
| *EmbeddedApi* | [**embeddedEditUrl**](docs/Api/EmbeddedApi.md#embeddedediturl) | **POST** /embedded/edit_url/{template_id} | Get Embedded Template Edit URL |
| *EmbeddedApi* | [**embeddedSignUrl**](docs/Api/EmbeddedApi.md#embeddedsignurl) | **GET** /embedded/sign_url/{signature_id} | Get Embedded Sign URL |
| *OAuthApi* | [**oauthTokenGenerate**](docs/Api/OAuthApi.md#oauthtokengenerate) | **POST** /oauth/token | OAuth Token Generate |
| *OAuthApi* | [**oauthTokenRefresh**](docs/Api/OAuthApi.md#oauthtokenrefresh) | **POST** /oauth/token?refresh | OAuth Token Refresh |
| *ReportApi* | [**reportCreate**](docs/Api/ReportApi.md#reportcreate) | **POST** /report/create | Create Report |
| *SignatureRequestApi* | [**signatureRequestBulkCreateEmbeddedWithTemplate**](docs/Api/SignatureRequestApi.md#signaturerequestbulkcreateembeddedwithtemplate) | **POST** /signature_request/bulk_create_embedded_with_template | Embedded Bulk Send with Template |
| *SignatureRequestApi* | [**signatureRequestBulkSendWithTemplate**](docs/Api/SignatureRequestApi.md#signaturerequestbulksendwithtemplate) | **POST** /signature_request/bulk_send_with_template | Bulk Send with Template |
| *SignatureRequestApi* | [**signatureRequestCancel**](docs/Api/SignatureRequestApi.md#signaturerequestcancel) | **POST** /signature_request/cancel/{signature_request_id} | Cancel Incomplete Signature Request |
| *SignatureRequestApi* | [**signatureRequestCreateEmbedded**](docs/Api/SignatureRequestApi.md#signaturerequestcreateembedded) | **POST** /signature_request/create_embedded | Create Embedded Signature Request |
| *SignatureRequestApi* | [**signatureRequestCreateEmbeddedWithTemplate**](docs/Api/SignatureRequestApi.md#signaturerequestcreateembeddedwithtemplate) | **POST** /signature_request/create_embedded_with_template | Create Embedded Signature Request with Template |
| *SignatureRequestApi* | [**signatureRequestFiles**](docs/Api/SignatureRequestApi.md#signaturerequestfiles) | **GET** /signature_request/files/{signature_request_id} | Download Files |
| *SignatureRequestApi* | [**signatureRequestFilesAsDataUri**](docs/Api/SignatureRequestApi.md#signaturerequestfilesasdatauri) | **GET** /signature_request/files_as_data_uri/{signature_request_id} | Download Files as Data Uri |
| *SignatureRequestApi* | [**signatureRequestFilesAsFileUrl**](docs/Api/SignatureRequestApi.md#signaturerequestfilesasfileurl) | **GET** /signature_request/files_as_file_url/{signature_request_id} | Download Files as File Url |
| *SignatureRequestApi* | [**signatureRequestGet**](docs/Api/SignatureRequestApi.md#signaturerequestget) | **GET** /signature_request/{signature_request_id} | Get Signature Request |
| *SignatureRequestApi* | [**signatureRequestList**](docs/Api/SignatureRequestApi.md#signaturerequestlist) | **GET** /signature_request/list | List Signature Requests |
| *SignatureRequestApi* | [**signatureRequestReleaseHold**](docs/Api/SignatureRequestApi.md#signaturerequestreleasehold) | **POST** /signature_request/release_hold/{signature_request_id} | Release On-Hold Signature Request |
| *SignatureRequestApi* | [**signatureRequestRemind**](docs/Api/SignatureRequestApi.md#signaturerequestremind) | **POST** /signature_request/remind/{signature_request_id} | Send Request Reminder |
| *SignatureRequestApi* | [**signatureRequestRemove**](docs/Api/SignatureRequestApi.md#signaturerequestremove) | **POST** /signature_request/remove/{signature_request_id} | Remove Signature Request Access |
| *SignatureRequestApi* | [**signatureRequestSend**](docs/Api/SignatureRequestApi.md#signaturerequestsend) | **POST** /signature_request/send | Send Signature Request |
| *SignatureRequestApi* | [**signatureRequestSendWithTemplate**](docs/Api/SignatureRequestApi.md#signaturerequestsendwithtemplate) | **POST** /signature_request/send_with_template | Send with Template |
| *SignatureRequestApi* | [**signatureRequestUpdate**](docs/Api/SignatureRequestApi.md#signaturerequestupdate) | **POST** /signature_request/update/{signature_request_id} | Update Signature Request |
| *TeamApi* | [**teamAddMember**](docs/Api/TeamApi.md#teamaddmember) | **PUT** /team/add_member | Add User to Team |
| *TeamApi* | [**teamCreate**](docs/Api/TeamApi.md#teamcreate) | **POST** /team/create | Create Team |
| *TeamApi* | [**teamDelete**](docs/Api/TeamApi.md#teamdelete) | **DELETE** /team/destroy | Delete Team |
| *TeamApi* | [**teamGet**](docs/Api/TeamApi.md#teamget) | **GET** /team | Get Team |
| *TeamApi* | [**teamInfo**](docs/Api/TeamApi.md#teaminfo) | **GET** /team/info | Get Team Info |
| *TeamApi* | [**teamInvites**](docs/Api/TeamApi.md#teaminvites) | **GET** /team/invites | List Team Invites |
| *TeamApi* | [**teamMembers**](docs/Api/TeamApi.md#teammembers) | **GET** /team/members/{team_id} | List Team Members |
| *TeamApi* | [**teamRemoveMember**](docs/Api/TeamApi.md#teamremovemember) | **POST** /team/remove_member | Remove User from Team |
| *TeamApi* | [**teamSubTeams**](docs/Api/TeamApi.md#teamsubteams) | **GET** /team/sub_teams/{team_id} | List Sub Teams |
| *TeamApi* | [**teamUpdate**](docs/Api/TeamApi.md#teamupdate) | **PUT** /team | Update Team |
| *TemplateApi* | [**templateAddUser**](docs/Api/TemplateApi.md#templateadduser) | **POST** /template/add_user/{template_id} | Add User to Template |
| *TemplateApi* | [**templateCreateEmbeddedDraft**](docs/Api/TemplateApi.md#templatecreateembeddeddraft) | **POST** /template/create_embedded_draft | Create Embedded Template Draft |
| *TemplateApi* | [**templateDelete**](docs/Api/TemplateApi.md#templatedelete) | **POST** /template/delete/{template_id} | Delete Template |
| *TemplateApi* | [**templateFiles**](docs/Api/TemplateApi.md#templatefiles) | **GET** /template/files/{template_id} | Get Template Files |
| *TemplateApi* | [**templateFilesAsDataUri**](docs/Api/TemplateApi.md#templatefilesasdatauri) | **GET** /template/files_as_data_uri/{template_id} | Get Template Files as Data Uri |
| *TemplateApi* | [**templateFilesAsFileUrl**](docs/Api/TemplateApi.md#templatefilesasfileurl) | **GET** /template/files_as_file_url/{template_id} | Get Template Files as File Url |
| *TemplateApi* | [**templateGet**](docs/Api/TemplateApi.md#templateget) | **GET** /template/{template_id} | Get Template |
| *TemplateApi* | [**templateList**](docs/Api/TemplateApi.md#templatelist) | **GET** /template/list | List Templates |
| *TemplateApi* | [**templateRemoveUser**](docs/Api/TemplateApi.md#templateremoveuser) | **POST** /template/remove_user/{template_id} | Remove User from Template |
| *TemplateApi* | [**templateUpdateFiles**](docs/Api/TemplateApi.md#templateupdatefiles) | **POST** /template/update_files/{template_id} | Update Template Files |
| *UnclaimedDraftApi* | [**unclaimedDraftCreate**](docs/Api/UnclaimedDraftApi.md#unclaimeddraftcreate) | **POST** /unclaimed_draft/create | Create Unclaimed Draft |
| *UnclaimedDraftApi* | [**unclaimedDraftCreateEmbedded**](docs/Api/UnclaimedDraftApi.md#unclaimeddraftcreateembedded) | **POST** /unclaimed_draft/create_embedded | Create Embedded Unclaimed Draft |
| *UnclaimedDraftApi* | [**unclaimedDraftCreateEmbeddedWithTemplate**](docs/Api/UnclaimedDraftApi.md#unclaimeddraftcreateembeddedwithtemplate) | **POST** /unclaimed_draft/create_embedded_with_template | Create Embedded Unclaimed Draft with Template |
| *UnclaimedDraftApi* | [**unclaimedDraftEditAndResend**](docs/Api/UnclaimedDraftApi.md#unclaimeddrafteditandresend) | **POST** /unclaimed_draft/edit_and_resend/{signature_request_id} | Edit and Resend Unclaimed Draft |

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
- [ErrorResponseError](docs/Model/ErrorResponseError.md)
- [EventCallbackRequest](docs/Model/EventCallbackRequest.md)
- [EventCallbackRequestEvent](docs/Model/EventCallbackRequestEvent.md)
- [EventCallbackRequestEventMetadata](docs/Model/EventCallbackRequestEventMetadata.md)
- [FileResponse](docs/Model/FileResponse.md)
- [FileResponseDataUri](docs/Model/FileResponseDataUri.md)
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
- [SignatureRequestResponseAttachment](docs/Model/SignatureRequestResponseAttachment.md)
- [SignatureRequestResponseCustomFieldBase](docs/Model/SignatureRequestResponseCustomFieldBase.md)
- [SignatureRequestResponseCustomFieldCheckbox](docs/Model/SignatureRequestResponseCustomFieldCheckbox.md)
- [SignatureRequestResponseCustomFieldText](docs/Model/SignatureRequestResponseCustomFieldText.md)
- [SignatureRequestResponseCustomFieldTypeEnum](docs/Model/SignatureRequestResponseCustomFieldTypeEnum.md)
- [SignatureRequestResponseDataBase](docs/Model/SignatureRequestResponseDataBase.md)
- [SignatureRequestResponseDataTypeEnum](docs/Model/SignatureRequestResponseDataTypeEnum.md)
- [SignatureRequestResponseDataValueCheckbox](docs/Model/SignatureRequestResponseDataValueCheckbox.md)
- [SignatureRequestResponseDataValueCheckboxMerge](docs/Model/SignatureRequestResponseDataValueCheckboxMerge.md)
- [SignatureRequestResponseDataValueDateSigned](docs/Model/SignatureRequestResponseDataValueDateSigned.md)
- [SignatureRequestResponseDataValueDropdown](docs/Model/SignatureRequestResponseDataValueDropdown.md)
- [SignatureRequestResponseDataValueInitials](docs/Model/SignatureRequestResponseDataValueInitials.md)
- [SignatureRequestResponseDataValueRadio](docs/Model/SignatureRequestResponseDataValueRadio.md)
- [SignatureRequestResponseDataValueSignature](docs/Model/SignatureRequestResponseDataValueSignature.md)
- [SignatureRequestResponseDataValueText](docs/Model/SignatureRequestResponseDataValueText.md)
- [SignatureRequestResponseDataValueTextMerge](docs/Model/SignatureRequestResponseDataValueTextMerge.md)
- [SignatureRequestResponseSignatures](docs/Model/SignatureRequestResponseSignatures.md)
- [SignatureRequestSendRequest](docs/Model/SignatureRequestSendRequest.md)
- [SignatureRequestSendWithTemplateRequest](docs/Model/SignatureRequestSendWithTemplateRequest.md)
- [SignatureRequestUpdateRequest](docs/Model/SignatureRequestUpdateRequest.md)
- [SubAttachment](docs/Model/SubAttachment.md)
- [SubBulkSignerList](docs/Model/SubBulkSignerList.md)
- [SubBulkSignerListCustomField](docs/Model/SubBulkSignerListCustomField.md)
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
- [SubSignatureRequestSigner](docs/Model/SubSignatureRequestSigner.md)
- [SubSignatureRequestTemplateSigner](docs/Model/SubSignatureRequestTemplateSigner.md)
- [SubSigningOptions](docs/Model/SubSigningOptions.md)
- [SubTeamResponse](docs/Model/SubTeamResponse.md)
- [SubTemplateRole](docs/Model/SubTemplateRole.md)
- [SubUnclaimedDraftSigner](docs/Model/SubUnclaimedDraftSigner.md)
- [SubUnclaimedDraftTemplateSigner](docs/Model/SubUnclaimedDraftTemplateSigner.md)
- [SubWhiteLabelingOptions](docs/Model/SubWhiteLabelingOptions.md)
- [TeamAddMemberRequest](docs/Model/TeamAddMemberRequest.md)
- [TeamCreateRequest](docs/Model/TeamCreateRequest.md)
- [TeamGetInfoResponse](docs/Model/TeamGetInfoResponse.md)
- [TeamGetResponse](docs/Model/TeamGetResponse.md)
- [TeamInfoResponse](docs/Model/TeamInfoResponse.md)
- [TeamInviteResponse](docs/Model/TeamInviteResponse.md)
- [TeamInvitesResponse](docs/Model/TeamInvitesResponse.md)
- [TeamMemberResponse](docs/Model/TeamMemberResponse.md)
- [TeamMembersResponse](docs/Model/TeamMembersResponse.md)
- [TeamParentResponse](docs/Model/TeamParentResponse.md)
- [TeamRemoveMemberRequest](docs/Model/TeamRemoveMemberRequest.md)
- [TeamResponse](docs/Model/TeamResponse.md)
- [TeamSubTeamsResponse](docs/Model/TeamSubTeamsResponse.md)
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
- [TemplateResponseDocumentFieldGroup](docs/Model/TemplateResponseDocumentFieldGroup.md)
- [TemplateResponseDocumentFormField](docs/Model/TemplateResponseDocumentFormField.md)
- [TemplateResponseDocumentStaticField](docs/Model/TemplateResponseDocumentStaticField.md)
- [TemplateResponseFieldAvgTextLength](docs/Model/TemplateResponseFieldAvgTextLength.md)
- [TemplateResponseNamedFormField](docs/Model/TemplateResponseNamedFormField.md)
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
    - Package version: `6.0.0-beta22.24`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
