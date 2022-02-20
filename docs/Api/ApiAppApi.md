# HelloSignSDK\ApiAppApi

All URIs are relative to https://api.hellosign.com/v3.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiAppCreate()**](ApiAppApi.md#apiAppCreate) | **POST** /api_app | Creates a new API App. |
| [**apiAppDelete()**](ApiAppApi.md#apiAppDelete) | **DELETE** /api_app/{client_id} | Deletes an API App. |
| [**apiAppGet()**](ApiAppApi.md#apiAppGet) | **GET** /api_app/{client_id} | Gets an API App. |
| [**apiAppList()**](ApiAppApi.md#apiAppList) | **GET** /api_app/list | Lists your API Apps. |
| [**apiAppUpdate()**](ApiAppApi.md#apiAppUpdate) | **PUT** /api_app/{client_id} | Updates an existing API App. |


## `apiAppCreate()`

```php
apiAppCreate($api_app_create_request): \HelloSignSDK\Model\ApiAppGetResponse
```

Creates a new API App.

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

$api = new HelloSignSDK\Api\ApiAppApi(
    new GuzzleHttp\Client(),
    $config
);

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
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
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

Deletes an API App.

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

$api = new HelloSignSDK\Api\ApiAppApi(
    new GuzzleHttp\Client(),
    $config
);

$clientId = "0dd3b823a682527788c4e40cb7b6f7e9";

try {
    $api->apiAppDelete($clientId);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **client_id** | **string**| The client id of the ApiApp to delete. | |

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

Gets an API App.

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

$api = new HelloSignSDK\Api\ApiAppApi(
    new GuzzleHttp\Client(),
    $config
);

$clientId = "0dd3b823a682527788c4e40cb7b6f7e9";

try {
    $result = $api->apiAppGet($clientId);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **client_id** | **string**| The client ID of the ApiApp to retrieve. | |

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

Lists your API Apps.

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

$api = new HelloSignSDK\Api\ApiAppApi(
    new GuzzleHttp\Client(),
    $config
);

$page = 1;
$pageSize = 2;

try {
    $result = $api->apiAppList($page, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **page** | **int**| Which page number of the ApiApp List to return. Defaults to `1`. | [optional] [default to 1] |
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

Updates an existing API App.

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

$api = new HelloSignSDK\Api\ApiAppApi(
    new GuzzleHttp\Client(),
    $config
);

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
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **client_id** | **string**| The client ID of the ApiApp to update. | |
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