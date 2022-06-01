# HelloSignSDK\ApiAppApi

All URIs are relative to https://api.hellosign.com/v3.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiAppCreate()**](ApiAppApi.md#apiAppCreate) | **POST** /api_app | Create API App |
| [**apiAppDelete()**](ApiAppApi.md#apiAppDelete) | **DELETE** /api_app/{client_id} | Delete API App |
| [**apiAppGet()**](ApiAppApi.md#apiAppGet) | **GET** /api_app/{client_id} | Get API App |
| [**apiAppList()**](ApiAppApi.md#apiAppList) | **GET** /api_app/list | List API Apps |
| [**apiAppUpdate()**](ApiAppApi.md#apiAppUpdate) | **PUT** /api_app/{client_id} | Update API App |


## `apiAppCreate()`

```php
apiAppCreate($api_app_create_request): \HelloSignSDK\Model\ApiAppGetResponse
```

Create API App

Creates a new API App.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\ApiAppApi($config);

$oauth = new HelloSignSDK\Model\SubOAuth();
$oauth->setCallbackUrl("https://example.com/oauth")
    ->setScopes([
        HelloSignSDK\Model\SubOAuth::SCOPES_BASIC_ACCOUNT_INFO,
        HelloSignSDK\Model\SubOAuth::SCOPES_REQUEST_SIGNATURE,
    ]);

$whiteLabelingOptions = new HelloSignSDK\Model\SubWhiteLabelingOptions();
$whiteLabelingOptions->setPrimaryButtonColor("#00b3e6")
    ->setPrimaryButtonTextColor("#ffffff");

$customLogoFile = new SplFileObject(__DIR__ . "/CustomLogoFile.png");

$data = new HelloSignSDK\Model\ApiAppCreateRequest();
$data->setName("My Production App")
    ->setDomains(["example.com"])
    ->setOauth($oauth)
    ->setWhiteLabelingOptions($whiteLabelingOptions)
    ->setCustomLogoFile($customLogoFile);

try {
    $result = $api->apiAppCreate($data);
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
| **api_app_create_request** | [**\HelloSignSDK\Model\ApiAppCreateRequest**](../Model/ApiAppCreateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\ApiAppGetResponse**](../Model/ApiAppGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAppDelete()`

```php
apiAppDelete($client_id)
```

Delete API App

Deletes an API App. Can only be invoked for apps you own.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\ApiAppApi($config);

$clientId = "0dd3b823a682527788c4e40cb7b6f7e9";

try {
    $api->apiAppDelete($clientId);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **client_id** | **string**| The client id of the API App to delete. | |

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

## `apiAppGet()`

```php
apiAppGet($client_id): \HelloSignSDK\Model\ApiAppGetResponse
```

Get API App

Returns an object with information about an API App.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\ApiAppApi($config);

$clientId = "0dd3b823a682527788c4e40cb7b6f7e9";

try {
    $result = $api->apiAppGet($clientId);
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
| **client_id** | **string**| The client id of the API App to retrieve. | |

### Return type

[**\HelloSignSDK\Model\ApiAppGetResponse**](../Model/ApiAppGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAppList()`

```php
apiAppList($page, $page_size): \HelloSignSDK\Model\ApiAppListResponse
```

List API Apps

Returns a list of API Apps that are accessible by you. If you are on a team with an Admin or Developer role, this list will include apps owned by teammates.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\ApiAppApi($config);

$page = 1;
$pageSize = 2;

try {
    $result = $api->apiAppList($page, $pageSize);
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
| **page** | **int**| Which page number of the API App List to return. Defaults to `1`. | [optional] [default to 1] |
| **page_size** | **int**| Number of objects to be returned per page. Must be between `1` and `100`. Default is `20`. | [optional] [default to 20] |

### Return type

[**\HelloSignSDK\Model\ApiAppListResponse**](../Model/ApiAppListResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiAppUpdate()`

```php
apiAppUpdate($client_id, $api_app_update_request): \HelloSignSDK\Model\ApiAppGetResponse
```

Update API App

Updates an existing API App. Can only be invoked for apps you own. Only the fields you provide will be updated. If you wish to clear an existing optional field, provide an empty string.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\ApiAppApi($config);

$whiteLabelingOptions = new HelloSignSDK\Model\SubWhiteLabelingOptions();
$whiteLabelingOptions->setPrimaryButtonColor("#00b3e6")
    ->setPrimaryButtonTextColor("#ffffff");

$customLogoFile = new SplFileObject(__DIR__ . "/CustomLogoFile.png");

$data = new HelloSignSDK\Model\ApiAppUpdateRequest();
$data->setName("New Name")
    ->setCallbackUrl("http://example.com/hellosign")
    ->setWhiteLabelingOptions($whiteLabelingOptions)
    ->setCustomLogoFile($customLogoFile);

$clientId = "0dd3b823a682527788c4e40cb7b6f7e9";

try {
    $result = $api->apiAppUpdate($clientId, $data);
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
| **client_id** | **string**| The client id of the API App to update. | |
| **api_app_update_request** | [**\HelloSignSDK\Model\ApiAppUpdateRequest**](../Model/ApiAppUpdateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\ApiAppGetResponse**](../Model/ApiAppGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
