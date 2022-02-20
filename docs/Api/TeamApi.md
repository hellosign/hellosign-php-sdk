# HelloSignSDK\TeamApi

All URIs are relative to https://api.hellosign.com/v3.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**teamAddMember()**](TeamApi.md#teamAddMember) | **PUT** /team/add_member | Adds or invites a user to your Team. |
| [**teamCreate()**](TeamApi.md#teamCreate) | **POST** /team/create | Creates a new Team. |
| [**teamDelete()**](TeamApi.md#teamDelete) | **DELETE** /team/destroy | Deletes your Team. |
| [**teamGet()**](TeamApi.md#teamGet) | **GET** /team | Gets your Team and a list of its members. |
| [**teamRemoveMember()**](TeamApi.md#teamRemoveMember) | **POST** /team/remove_member | Removes a user from your Team. |
| [**teamUpdate()**](TeamApi.md#teamUpdate) | **PUT** /team | Updates a Team&#39;s name. |


## `teamAddMember()`

```php
teamAddMember($team_add_member_request): \HelloSignSDK\Model\TeamGetResponse
```

Adds or invites a user to your Team.

Invites a user (specified using the `email_address` parameter) to your Team. If the user does not currently have a HelloSign Account, a new one will be created for them. If a user is already a part of another Team, a `team_invite_failed` error will be returned.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi(
    new GuzzleHttp\Client(),
    $config
);

$data = new HelloSignSDK\Model\TeamAddMemberRequest();
$data->setEmailAddress("george@example.com");

try {
    $result = $api->teamAddMember($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **team_add_member_request** | [**\HelloSignSDK\Model\TeamAddMemberRequest**](../Model/TeamAddMemberRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\TeamGetResponse**](../Model/TeamGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `teamCreate()`

```php
teamCreate($team_create_request): \HelloSignSDK\Model\TeamGetResponse
```

Creates a new Team.

Creates a new Team and makes you a member. You must not currently belong to a Team to invoke.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi(
    new GuzzleHttp\Client(),
    $config
);

$data = new HelloSignSDK\Model\TeamCreateRequest();
$data->setName("New Team Name");

try {
    $result = $api->teamCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **team_create_request** | [**\HelloSignSDK\Model\TeamCreateRequest**](../Model/TeamCreateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\TeamGetResponse**](../Model/TeamGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `teamDelete()`

```php
teamDelete()
```

Deletes your Team.

Deletes your Team. Can only be invoked when you have a Team with only one member (yourself).

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi(
    new GuzzleHttp\Client(),
    $config
);

try {
    $api->teamDelete();
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|This endpoint does not need any parameter. |

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

## `teamGet()`

```php
teamGet(): \HelloSignSDK\Model\TeamGetResponse
```

Gets your Team and a list of its members.

Returns information about your Team as well as a list of its members. If you do not belong to a Team, a 404 error with an error_name of \"not_found\" will be returned.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi(
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $api->teamGet();
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|This endpoint does not need any parameter. |

### Return type

[**\HelloSignSDK\Model\TeamGetResponse**](../Model/TeamGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `teamRemoveMember()`

```php
teamRemoveMember($team_remove_member_request): \HelloSignSDK\Model\TeamGetResponse
```

Removes a user from your Team.

Removes the provided user Account from your Team. If the Account had an outstanding invitation to your Team, the invitation will be expired. If you choose to transfer documents from the removed Account to an Account provided in the `new_owner_email_address` parameter (available only for Enterprise plans), the response status code will be 201, which indicates that your request has been queued but not fully executed.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi(
    new GuzzleHttp\Client(),
    $config
);

$data = new HelloSignSDK\Model\TeamRemoveMemberRequest();
$data->setEmailAddress("teammate@hellosign.com")
    ->setNewOwnerEmailAddress("new_teammate@hellosign.com");

try {
    $result = $api->teamRemoveMember($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **team_remove_member_request** | [**\HelloSignSDK\Model\TeamRemoveMemberRequest**](../Model/TeamRemoveMemberRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\TeamGetResponse**](../Model/TeamGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `teamUpdate()`

```php
teamUpdate($team_update_request): \HelloSignSDK\Model\TeamGetResponse
```

Updates a Team's name.

Updates the name of your Team.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi(
    new GuzzleHttp\Client(),
    $config
);

$data = new HelloSignSDK\Model\TeamUpdateRequest();
$data->setName("New Team Name");

try {
    $result = $api->teamUpdate($data);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling HelloSign API: "
        . $e->getMessage() . PHP_EOL;
}

```

### Parameters

|Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **team_update_request** | [**\HelloSignSDK\Model\TeamUpdateRequest**](../Model/TeamUpdateRequest.md)|  | |

### Return type

[**\HelloSignSDK\Model\TeamGetResponse**](../Model/TeamGetResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)