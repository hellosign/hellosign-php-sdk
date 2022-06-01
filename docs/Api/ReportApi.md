# HelloSignSDK\ReportApi

All URIs are relative to https://api.hellosign.com/v3.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**reportCreate()**](ReportApi.md#reportCreate) | **POST** /report/create | Create Report |


## `reportCreate()`

```php
reportCreate($report_create_request): \HelloSignSDK\Model\ReportCreateResponse
```

Create Report

Request the creation of one or more report(s).  When the report(s) have been generated, you will receive an email (one per requested report type) containing a link to download the report as a CSV file. The requested date range may be up to 12 months in duration, and `start_date` must not be more than 10 years in the past.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

$api = new HelloSignSDK\Api\ReportApi($config);

$data = new HelloSignSDK\Model\ReportCreateRequest();
$data->setStartDate("09/01/2020")
    ->setEndDate("09/01/2020")
    ->setReportType([
        HelloSignSDK\Model\ReportCreateRequest::REPORT_TYPE_USER_ACTIVITY,
        HelloSignSDK\Model\ReportCreateRequest::REPORT_TYPE_DOCUMENT_STATUS,
    ]);

try {
    $result = $api->reportCreate($data);
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
| **report_create_request** | [**\HelloSignSDK\Model\ReportCreateRequest**](../Model/ReportCreateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\ReportCreateResponse**](../Model/ReportCreateResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
