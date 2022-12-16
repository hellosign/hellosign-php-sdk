# HelloSignSDK\SignatureRequestApi

All URIs are relative to https://api.hellosign.com/v3.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**signatureRequestBulkCreateEmbeddedWithTemplate()**](SignatureRequestApi.md#signatureRequestBulkCreateEmbeddedWithTemplate) | **POST** /signature_request/bulk_create_embedded_with_template | Embedded Bulk Send with Template |
| [**signatureRequestBulkSendWithTemplate()**](SignatureRequestApi.md#signatureRequestBulkSendWithTemplate) | **POST** /signature_request/bulk_send_with_template | Bulk Send with Template |
| [**signatureRequestCancel()**](SignatureRequestApi.md#signatureRequestCancel) | **POST** /signature_request/cancel/{signature_request_id} | Cancel Incomplete Signature Request |
| [**signatureRequestCreateEmbedded()**](SignatureRequestApi.md#signatureRequestCreateEmbedded) | **POST** /signature_request/create_embedded | Create Embedded Signature Request |
| [**signatureRequestCreateEmbeddedWithTemplate()**](SignatureRequestApi.md#signatureRequestCreateEmbeddedWithTemplate) | **POST** /signature_request/create_embedded_with_template | Create Embedded Signature Request with Template |
| [**signatureRequestFiles()**](SignatureRequestApi.md#signatureRequestFiles) | **GET** /signature_request/files/{signature_request_id} | Download Files |
| [**signatureRequestFilesAsDataUri()**](SignatureRequestApi.md#signatureRequestFilesAsDataUri) | **GET** /signature_request/files_as_data_uri/{signature_request_id} | Download Files as Data Uri |
| [**signatureRequestFilesAsFileUrl()**](SignatureRequestApi.md#signatureRequestFilesAsFileUrl) | **GET** /signature_request/files_as_file_url/{signature_request_id} | Download Files as File Url |
| [**signatureRequestGet()**](SignatureRequestApi.md#signatureRequestGet) | **GET** /signature_request/{signature_request_id} | Get Signature Request |
| [**signatureRequestList()**](SignatureRequestApi.md#signatureRequestList) | **GET** /signature_request/list | List Signature Requests |
| [**signatureRequestReleaseHold()**](SignatureRequestApi.md#signatureRequestReleaseHold) | **POST** /signature_request/release_hold/{signature_request_id} | Release On-Hold Signature Request |
| [**signatureRequestRemind()**](SignatureRequestApi.md#signatureRequestRemind) | **POST** /signature_request/remind/{signature_request_id} | Send Request Reminder |
| [**signatureRequestRemove()**](SignatureRequestApi.md#signatureRequestRemove) | **POST** /signature_request/remove/{signature_request_id} | Remove Signature Request Access |
| [**signatureRequestSend()**](SignatureRequestApi.md#signatureRequestSend) | **POST** /signature_request/send | Send Signature Request |
| [**signatureRequestSendWithTemplate()**](SignatureRequestApi.md#signatureRequestSendWithTemplate) | **POST** /signature_request/send_with_template | Send with Template |
| [**signatureRequestUpdate()**](SignatureRequestApi.md#signatureRequestUpdate) | **POST** /signature_request/update/{signature_request_id} | Update Signature Request |


## `signatureRequestBulkCreateEmbeddedWithTemplate()`

```php
signatureRequestBulkCreateEmbeddedWithTemplate($signature_request_bulk_create_embedded_with_template_request): \HelloSignSDK\Model\BulkSendJobSendResponse
```

Embedded Bulk Send with Template

Creates BulkSendJob which sends up to 250 SignatureRequests in bulk based off of the provided Template(s) specified with the `template_ids` parameter to be signed in an embedded iFrame. These embedded signature requests can only be signed in embedded iFrames whereas normal signature requests can only be signed on Dropbox Sign.  **NOTE**: Only available for Standard plan and higher.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

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

$data = new HelloSignSDK\Model\SignatureRequestBulkCreateEmbeddedWithTemplateRequest();
$data->setClientId("1a659d9ad95bccd307ecad78d72192f8")
    ->setTemplateIds(["c26b8a16784a872da37ea946b9ddec7c1e11dff6"])
    ->setSubject("Purchase Order")
    ->setMessage("Glad we could come to an agreement.")
    ->setSignerList([$signerList1, $signerList2])
    ->setCcs([$cc1])
    ->setTestMode(true);

try {
    $result = $api->signatureRequestBulkCreateEmbeddedWithTemplate($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_bulk_create_embedded_with_template_request** | [**\HelloSignSDK\Model\SignatureRequestBulkCreateEmbeddedWithTemplateRequest**](../Model/SignatureRequestBulkCreateEmbeddedWithTemplateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\BulkSendJobSendResponse**](../Model/BulkSendJobSendResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

- **Content-Type**: `application/json`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestBulkSendWithTemplate()`

```php
signatureRequestBulkSendWithTemplate($signature_request_bulk_send_with_template_request): \HelloSignSDK\Model\BulkSendJobSendResponse
```

Bulk Send with Template

Creates BulkSendJob which sends up to 250 SignatureRequests in bulk based off of the provided Template(s) specified with the `template_ids` parameter.  **NOTE**: Only available for Standard plan and higher.

### Example

```php
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
$data->setTemplateIds(["c26b8a16784a872da37ea946b9ddec7c1e11dff6"])
    ->setSubject("Purchase Order")
    ->setMessage("Glad we could come to an agreement.")
    ->setSignerList([$signerList1, $signerList2])
    ->setCcs([$cc1])
    ->setTestMode(true);

try {
    $result = $api->signatureRequestBulkSendWithTemplate($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_bulk_send_with_template_request** | [**\HelloSignSDK\Model\SignatureRequestBulkSendWithTemplateRequest**](../Model/SignatureRequestBulkSendWithTemplateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\BulkSendJobSendResponse**](../Model/BulkSendJobSendResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestCancel()`

```php
signatureRequestCancel($signature_request_id)
```

Cancel Incomplete Signature Request

Cancels an incomplete signature request. This action is **not reversible**.  The request will be canceled and signers will no longer be able to sign. If they try to access the signature request they will receive a HTTP 410 status code indicating that the resource has been deleted. Cancelation is asynchronous and a successful call to this endpoint will return an empty 200 OK response if the signature request is eligible to be canceled and has been successfully queued.  This 200 OK response does not indicate a successful cancelation of the signature request itself. The cancelation is confirmed via the `signature_request_canceled` event. It is recommended that a  [callback handler](/api/reference/tag/Callbacks-and-Events) be implemented to listen for the `signature_request_canceled` event. This callback will be sent only when the cancelation has completed successfully. If a callback handler has been configured and the event has not been received within 60 minutes of making the call, check the status of the request in the [API Dashboard](https://app.hellosign.com/apidashboard) and retry the cancelation if necessary.  To be eligible for cancelation, a signature request must have been sent successfully, must not yet have been signed by all signers, and you must either be the sender or own the API app under which it was sent. A partially signed signature request can be canceled.  **NOTE**: To remove your access to a completed signature request, use the endpoint: `POST /signature_request/remove/[:signature_request_id]`.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signatureRequestId = "2f9781e1a8e2045224d808c153c2e1d3df6f8f2f";

try {
    $api->signatureRequestCancel($signatureRequestId);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the incomplete SignatureRequest to cancel. | |

### Return type

void (empty response body)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestCreateEmbedded()`

```php
signatureRequestCreateEmbedded($signature_request_create_embedded_request): \HelloSignSDK\Model\SignatureRequestGetResponse
```

Create Embedded Signature Request

Creates a new SignatureRequest with the submitted documents to be signed in an embedded iFrame. If form_fields_per_document is not specified, a signature page will be affixed where all signers will be required to add their signature, signifying their agreement to all contained documents. <u>Note</u> that embedded signature requests can only be signed in embedded iFrames whereas normal signature requests can only be signed on Dropbox Sign.

### Example

```php
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

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_create_embedded_request** | [**\HelloSignSDK\Model\SignatureRequestCreateEmbeddedRequest**](../Model/SignatureRequestCreateEmbeddedRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\SignatureRequestGetResponse**](../Model/SignatureRequestGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestCreateEmbeddedWithTemplate()`

```php
signatureRequestCreateEmbeddedWithTemplate($signature_request_create_embedded_with_template_request): \HelloSignSDK\Model\SignatureRequestGetResponse
```

Create Embedded Signature Request with Template

Creates a new SignatureRequest based on the given Template(s) to be signed in an embedded iFrame. <u>Note</u> that embedded signature requests can only be signed in embedded iFrames whereas normal signature requests can only be signed on Dropbox Sign.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signer1 = new HelloSignSDK\Model\SubSignatureRequestTemplateSigner();
$signer1->setRole("Client")
    ->setEmailAddress("george@example.com")
    ->setName("George");

$signingOptions = new HelloSignSDK\Model\SubSigningOptions();
$signingOptions->setDraw(true)
    ->setType(true)
    ->setUpload(true)
    ->setPhone(false)
    ->setDefaultType(HelloSignSDK\Model\SubSigningOptions::DEFAULT_TYPE_DRAW);

$data = new HelloSignSDK\Model\SignatureRequestCreateEmbeddedWithTemplateRequest();
$data->setClientId("ec64a202072370a737edf4a0eb7f4437")
    ->setTemplateIds(["c26b8a16784a872da37ea946b9ddec7c1e11dff6"])
    ->setSubject("Purchase Order")
    ->setMessage("Glad we could come to an agreement.")
    ->setSigners([$signer1])
    ->setSigningOptions($signingOptions)
    ->setTestMode(true);

try {
    $result = $api->signatureRequestCreateEmbeddedWithTemplate($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_create_embedded_with_template_request** | [**\HelloSignSDK\Model\SignatureRequestCreateEmbeddedWithTemplateRequest**](../Model/SignatureRequestCreateEmbeddedWithTemplateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\SignatureRequestGetResponse**](../Model/SignatureRequestGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestFiles()`

```php
signatureRequestFiles($signature_request_id, $file_type): \SplFileObject
```

Download Files

Obtain a copy of the current documents specified by the `signature_request_id` parameter. Returns a PDF or ZIP file.  If the files are currently being prepared, a status code of `409` will be returned instead.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signatureRequestId = "fa5c8a0b0f492d768749333ad6fcc214c111e967";
$fileType = "pdf";

try {
    $result = $api->signatureRequestFiles($signatureRequestId, $fileType);
    copy($result->getRealPath(), __DIR__ . '/file_response.pdf');
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the SignatureRequest to retrieve. | |
| **file_type** | **string**| Set to `pdf` for a single merged document or `zip` for a collection of individual documents. | [optional] [default to &#39;pdf&#39;] |

### Return type

**\SplFileObject**

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/pdf`, `application/zip`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestFilesAsDataUri()`

```php
signatureRequestFilesAsDataUri($signature_request_id): \HelloSignSDK\Model\FileResponseDataUri
```

Download Files as Data Uri

Obtain a copy of the current documents specified by the `signature_request_id` parameter. Returns a JSON object with a `data_uri` representing the base64 encoded file (PDFs only).  If the files are currently being prepared, a status code of `409` will be returned instead.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signatureRequestId = "fa5c8a0b0f492d768749333ad6fcc214c111e967";

try {
    $result = $api->signatureRequestFilesAsDataUri($signatureRequestId);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the SignatureRequest to retrieve. | |

### Return type

[**\HelloSignSDK\Model\FileResponseDataUri**](../Model/FileResponseDataUri.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestFilesAsFileUrl()`

```php
signatureRequestFilesAsFileUrl($signature_request_id): \HelloSignSDK\Model\FileResponse
```

Download Files as File Url

Obtain a copy of the current documents specified by the `signature_request_id` parameter. Returns a JSON object with a url to the file (PDFs only).  If the files are currently being prepared, a status code of `409` will be returned instead.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signatureRequestId = "fa5c8a0b0f492d768749333ad6fcc214c111e967";

try {
    $result = $api->signatureRequestFilesAsFileUrl($signatureRequestId);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the SignatureRequest to retrieve. | |

### Return type

[**\HelloSignSDK\Model\FileResponse**](../Model/FileResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestGet()`

```php
signatureRequestGet($signature_request_id): \HelloSignSDK\Model\SignatureRequestGetResponse
```

Get Signature Request

Returns the status of the SignatureRequest specified by the `signature_request_id` parameter.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signatureRequestId = "fa5c8a0b0f492d768749333ad6fcc214c111e967";

try {
    $result = $api->signatureRequestGet($signatureRequestId);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the SignatureRequest to retrieve. | |

### Return type

[**\HelloSignSDK\Model\SignatureRequestGetResponse**](../Model/SignatureRequestGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestList()`

```php
signatureRequestList($account_id, $page, $page_size, $query): \HelloSignSDK\Model\SignatureRequestListResponse
```

List Signature Requests

Returns a list of SignatureRequests that you can access. This includes SignatureRequests you have sent as well as received, but not ones that you have been CCed on.  Take a look at our [search guide](/api/reference/search/) to learn more about querying signature requests.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$accountId = null;
$page = 1;

try {
    $result = $api->signatureRequestList($accountId, $page);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **account_id** | **string**| Which account to return SignatureRequests for. Must be a team member. Use `all` to indicate all team members. Defaults to your account. | [optional] |
| **page** | **int**| Which page number of the SignatureRequest List to return. Defaults to `1`. | [optional] [default to 1] |
| **page_size** | **int**| Number of objects to be returned per page. Must be between `1` and `100`. Default is `20`. | [optional] [default to 20] |
| **query** | **string**| String that includes search terms and/or fields to be used to filter the SignatureRequest objects. | [optional] |

### Return type

[**\HelloSignSDK\Model\SignatureRequestListResponse**](../Model/SignatureRequestListResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestReleaseHold()`

```php
signatureRequestReleaseHold($signature_request_id): \HelloSignSDK\Model\SignatureRequestGetResponse
```

Release On-Hold Signature Request

Releases a held SignatureRequest that was claimed and prepared from an [UnclaimedDraft](/api/reference/tag/Unclaimed-Draft). The owner of the Draft must indicate at Draft creation that the SignatureRequest created from the Draft should be held. Releasing the SignatureRequest will send requests to all signers.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signatureRequestId = "2f9781e1a8e2045224d808c153c2e1d3df6f8f2f";

try {
    $result = $api->signatureRequestReleaseHold($signatureRequestId);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the SignatureRequest to release. | |

### Return type

[**\HelloSignSDK\Model\SignatureRequestGetResponse**](../Model/SignatureRequestGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestRemind()`

```php
signatureRequestRemind($signature_request_id, $signature_request_remind_request): \HelloSignSDK\Model\SignatureRequestGetResponse
```

Send Request Reminder

Sends an email to the signer reminding them to sign the signature request. You cannot send a reminder within 1 hour of the last reminder that was sent. This includes manual AND automatic reminders.  **NOTE**: This action can **not** be used with embedded signature requests.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$data = new HelloSignSDK\Model\SignatureRequestRemindRequest();
$data->setEmailAddress("john@example.com");

$signatureRequestId = "2f9781e1a8e2045224d808c153c2e1d3df6f8f2f";

try {
    $result = $api->signatureRequestRemind($signatureRequestId, $data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the SignatureRequest to send a reminder for. | |
| **signature_request_remind_request** | [**\HelloSignSDK\Model\SignatureRequestRemindRequest**](../Model/SignatureRequestRemindRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\SignatureRequestGetResponse**](../Model/SignatureRequestGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestRemove()`

```php
signatureRequestRemove($signature_request_id)
```

Remove Signature Request Access

Removes your access to a completed signature request. This action is **not reversible**.  The signature request must be fully executed by all parties (signed or declined to sign). Other parties will continue to maintain access to the completed signature request document(s).  Unlike /signature_request/cancel, this endpoint is synchronous and your access will be immediately removed. Upon successful removal, this endpoint will return a 200 OK response.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$signatureRequestId = "2f9781e1a8e2045224d808c153c2e1d3df6f8f2f";

try {
    $api->signatureRequestRemove($signatureRequestId);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the SignatureRequest to remove. | |

### Return type

void (empty response body)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestSend()`

```php
signatureRequestSend($signature_request_send_request): \HelloSignSDK\Model\SignatureRequestGetResponse
```

Send Signature Request

Creates and sends a new SignatureRequest with the submitted documents. If `form_fields_per_document` is not specified, a signature page will be affixed where all signers will be required to add their signature, signifying their agreement to all contained documents.

### Example

```php
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
    ->setPhone(false)
    ->setDefaultType(HelloSignSDK\Model\SubSigningOptions::DEFAULT_TYPE_DRAW);

$fieldOptions = new HelloSignSDK\Model\SubFieldOptions();
$fieldOptions->setDateFormat(HelloSignSDK\Model\SubFieldOptions::DATE_FORMAT_DD_MM_YYYY);

$data = new HelloSignSDK\Model\SignatureRequestSendRequest();
$data->setTitle("NDA with Acme Co.")
    ->setSubject("The NDA we talked about")
    ->setMessage("Please sign this NDA and then we can discuss more. Let me know if you have any questions.")
    ->setSigners([$signer1, $signer2])
    ->setCcEmailAddresses([
        "lawyer@hellosign.com",
        "lawyer@example.com",
    ])
    ->setFile([new SplFileObject(__DIR__ . "/example_signature_request.pdf")])
    ->setMetadata([
        "custom_id" => 1234,
        "custom_text" => "NDA #9",
    ])
    ->setSigningOptions($signingOptions)
    ->setFieldOptions($fieldOptions)
    ->setTestMode(true);

try {
    $result = $api->signatureRequestSend($data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_send_request** | [**\HelloSignSDK\Model\SignatureRequestSendRequest**](../Model/SignatureRequestSendRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\SignatureRequestGetResponse**](../Model/SignatureRequestGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestSendWithTemplate()`

```php
signatureRequestSendWithTemplate($signature_request_send_with_template_request): \HelloSignSDK\Model\SignatureRequestGetResponse
```

Send with Template

Creates and sends a new SignatureRequest based off of the Template(s) specified with the `template_ids` parameter.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

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
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_send_with_template_request** | [**\HelloSignSDK\Model\SignatureRequestSendWithTemplateRequest**](../Model/SignatureRequestSendWithTemplateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\SignatureRequestGetResponse**](../Model/SignatureRequestGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signatureRequestUpdate()`

```php
signatureRequestUpdate($signature_request_id, $signature_request_update_request): \HelloSignSDK\Model\SignatureRequestGetResponse
```

Update Signature Request

Updates the email address and/or the name for a given signer on a signature request. You can listen for the `signature_request_email_bounce` event on your app or account to detect bounced emails, and respond with this method.  **NOTE**: This action cannot be performed on a signature request with an appended signature page.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\SignatureRequestApi($config);

$data = new HelloSignSDK\Model\SignatureRequestUpdateRequest();
$data->setEmailAddress("john@example.com")
    ->setSignatureId("78caf2a1d01cd39cea2bc1cbb340dac3");

$signatureRequestId = "2f9781e1a8e2045224d808c153c2e1d3df6f8f2f";

try {
    $result = $api->signatureRequestUpdate($signatureRequestId, $data);
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signature_request_id** | **string**| The id of the SignatureRequest to update. | |
| **signature_request_update_request** | [**\HelloSignSDK\Model\SignatureRequestUpdateRequest**](../Model/SignatureRequestUpdateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\SignatureRequestGetResponse**](../Model/SignatureRequestGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
