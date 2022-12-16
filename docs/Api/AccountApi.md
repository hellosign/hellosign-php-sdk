# HelloSignSDK\AccountApi

All URIs are relative to https://api.hellosign.com/v3.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**accountCreate()**](AccountApi.md#accountCreate) | **POST** /account/create | Create Account |
| [**accountGet()**](AccountApi.md#accountGet) | **GET** /account | Get Account |
| [**accountUpdate()**](AccountApi.md#accountUpdate) | **PUT** /account | Update Account |
| [**accountVerify()**](AccountApi.md#accountVerify) | **POST** /account/verify | Verify Account |


## `accountCreate()`

```php
accountCreate($account_create_request): \HelloSignSDK\Model\AccountCreateResponse
```

Create Account

Creates a new Dropbox Sign Account that is associated with the specified `email_address`.

### Example

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

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **account_create_request** | [**\HelloSignSDK\Model\AccountCreateRequest**](../Model/AccountCreateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\AccountCreateResponse**](../Model/AccountCreateResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `accountGet()`

```php
accountGet($account_id, $email_address): \HelloSignSDK\Model\AccountGetResponse
```

Get Account

Returns the properties and settings of your Account.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\AccountApi($config);

try {
    $result = $api->accountGet(null, 'jack@example.com');
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
| **account_id** | **string**| `account_id` or `email_address` is required. If both are provided, the account id prevails.  The ID of the Account. | [optional] |
| **email_address** | **string**| `account_id` or `email_address` is required, If both are provided, the account id prevails.  The email address of the Account. | [optional] |

### Return type

[**\HelloSignSDK\Model\AccountGetResponse**](../Model/AccountGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `accountUpdate()`

```php
accountUpdate($account_update_request): \HelloSignSDK\Model\AccountGetResponse
```

Update Account

Updates the properties and settings of your Account. Currently only allows for updates to the [Callback URL](/api/reference/tag/Callbacks-and-Events) and locale.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\AccountApi($config);

$data = new HelloSignSDK\Model\AccountUpdateRequest();
$data->setCallbackUrl("https://www.example.com/callback");

try {
    $result = $api->accountUpdate($data);
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
| **account_update_request** | [**\HelloSignSDK\Model\AccountUpdateRequest**](../Model/AccountUpdateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\AccountGetResponse**](../Model/AccountGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `accountVerify()`

```php
accountVerify($account_verify_request): \HelloSignSDK\Model\AccountVerifyResponse
```

Verify Account

Verifies whether an Dropbox Sign Account exists for the given email address.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\AccountApi($config);

$data = new HelloSignSDK\Model\AccountVerifyRequest();
$data->setEmailAddress("some_user@hellosign.com");

try {
    $result = $api->accountVerify($data);
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
| **account_verify_request** | [**\HelloSignSDK\Model\AccountVerifyRequest**](../Model/AccountVerifyRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\AccountVerifyResponse**](../Model/AccountVerifyResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
