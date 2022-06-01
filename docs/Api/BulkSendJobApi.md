# HelloSignSDK\BulkSendJobApi

All URIs are relative to https://api.hellosign.com/v3.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**bulkSendJobGet()**](BulkSendJobApi.md#bulkSendJobGet) | **GET** /bulk_send_job/{bulk_send_job_id} | Get Bulk Send Job |
| [**bulkSendJobList()**](BulkSendJobApi.md#bulkSendJobList) | **GET** /bulk_send_job/list | List Bulk Send Jobs |


## `bulkSendJobGet()`

```php
bulkSendJobGet($bulk_send_job_id): \HelloSignSDK\Model\BulkSendJobGetResponse
```

Get Bulk Send Job

Returns the status of the BulkSendJob and its SignatureRequests specified by the `bulk_send_job_id` parameter.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\BulkSendJobApi($config);

$bulkSendJobId = "6e683bc0369ba3d5b6f43c2c22a8031dbf6bd174";

try {
    $result = $api->bulkSendJobGet($bulkSendJobId);
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
| **bulk_send_job_id** | **string**| The id of the BulkSendJob to retrieve. | |

### Return type

[**\HelloSignSDK\Model\BulkSendJobGetResponse**](../Model/BulkSendJobGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `bulkSendJobList()`

```php
bulkSendJobList($page, $page_size): \HelloSignSDK\Model\BulkSendJobListResponse
```

List Bulk Send Jobs

Returns a list of BulkSendJob that you can access.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\BulkSendJobApi($config);

$page = 1;
$pageSize = 20;

try {
    $result = $api->bulkSendJobList($page, $pageSize);
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
| **page** | **int**| Which page number of the BulkSendJob List to return. Defaults to `1`. | [optional] [default to 1] |
| **page_size** | **int**| Number of objects to be returned per page. Must be between `1` and `100`. Default is 20. | [optional] [default to 20] |

### Return type

[**\HelloSignSDK\Model\BulkSendJobListResponse**](../Model/BulkSendJobListResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
