# HelloSignSDK\TeamApi

All URIs are relative to https://api.hellosign.com/v3.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**teamAddMember()**](TeamApi.md#teamAddMember) | **PUT** /team/add_member | Add User to Team |
| [**teamCreate()**](TeamApi.md#teamCreate) | **POST** /team/create | Create Team |
| [**teamDelete()**](TeamApi.md#teamDelete) | **DELETE** /team/destroy | Delete Team |
| [**teamGet()**](TeamApi.md#teamGet) | **GET** /team | Get Team |
| [**teamInfo()**](TeamApi.md#teamInfo) | **GET** /team/info | Get Team Info |
| [**teamInvites()**](TeamApi.md#teamInvites) | **GET** /team/invites | List Team Invites |
| [**teamMembers()**](TeamApi.md#teamMembers) | **GET** /team/members/{team_id} | List Team Members |
| [**teamRemoveMember()**](TeamApi.md#teamRemoveMember) | **POST** /team/remove_member | Remove User from Team |
| [**teamSubTeams()**](TeamApi.md#teamSubTeams) | **GET** /team/sub_teams/{team_id} | List Sub Teams |
| [**teamUpdate()**](TeamApi.md#teamUpdate) | **PUT** /team | Update Team |


## `teamAddMember()`

```php
teamAddMember($team_add_member_request, $team_id): \HelloSignSDK\Model\TeamGetResponse
```

Add User to Team

Invites a user (specified using the `email_address` parameter) to your Team. If the user does not currently have a Dropbox Sign Account, a new one will be created for them. If a user is already a part of another Team, a `team_invite_failed` error will be returned.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi($config);

$data = new HelloSignSDK\Model\TeamAddMemberRequest();
$data->setEmailAddress("george@example.com");

try {
    $result = $api->teamAddMember($data);
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
| **team_add_member_request** | [**\HelloSignSDK\Model\TeamAddMemberRequest**](../Model/TeamAddMemberRequest.md)|  | |
| **team_id** | **string**| The id of the team. | [optional] |

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

Create Team

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

$api = new HelloSignSDK\Api\TeamApi($config);

$data = new HelloSignSDK\Model\TeamCreateRequest();
$data->setName("New Team Name");

try {
    $result = $api->teamCreate($data);
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

Delete Team

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

$api = new HelloSignSDK\Api\TeamApi($config);

try {
    $api->teamDelete();
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
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

Get Team

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

$api = new HelloSignSDK\Api\TeamApi($config);

try {
    $result = $api->teamGet();
    print_r($result);
} catch (HelloSignSDK\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling HelloSign API: "
        . print_r($error->getError());
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

## `teamInfo()`

```php
teamInfo($team_id): \HelloSignSDK\Model\TeamGetInfoResponse
```

Get Team Info

Provides information about a team.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi($config);

try {
    $result = $api->teamInfo();
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
| **team_id** | **string**| The id of the team. | [optional] |

### Return type

[**\HelloSignSDK\Model\TeamGetInfoResponse**](../Model/TeamGetInfoResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `teamInvites()`

```php
teamInvites($email_address): \HelloSignSDK\Model\TeamInvitesResponse
```

List Team Invites

Provides a list of team invites (and their roles).

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi($config);

$emailAddress = "user@hellosign.com";

try {
    $result = $api->teamInvites($emailAddress);
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
| **email_address** | **string**| The email address for which to display the team invites. | [optional] |

### Return type

[**\HelloSignSDK\Model\TeamInvitesResponse**](../Model/TeamInvitesResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `teamMembers()`

```php
teamMembers($team_id, $page, $page_size): \HelloSignSDK\Model\TeamMembersResponse
```

List Team Members

Provides a paginated list of members (and their roles) that belong to a given team.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi($config);

$teamId = "4fea99bfcf2b26bfccf6cea3e127fb8bb74d8d9c";

try {
    $result = $api->teamMembers($teamId);
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
| **team_id** | **string**| The id of the team that a member list is being requested from. | |
| **page** | **int**| Which page number of the team member list to return. Defaults to `1`. | [optional] [default to 1] |
| **page_size** | **int**| Number of objects to be returned per page. Must be between `1` and `100`. Default is `20`. | [optional] [default to 20] |

### Return type

[**\HelloSignSDK\Model\TeamMembersResponse**](../Model/TeamMembersResponse.md)

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

Remove User from Team

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

$api = new HelloSignSDK\Api\TeamApi($config);

$data = new HelloSignSDK\Model\TeamRemoveMemberRequest();
$data->setEmailAddress("teammate@hellosign.com")
    ->setNewOwnerEmailAddress("new_teammate@hellosign.com");

try {
    $result = $api->teamRemoveMember($data);
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

## `teamSubTeams()`

```php
teamSubTeams($team_id, $page, $page_size): \HelloSignSDK\Model\TeamSubTeamsResponse
```

List Sub Teams

Provides a paginated list of sub teams that belong to a given team.

### Example

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = HelloSignSDK\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("YOUR_API_KEY");

// or, configure Bearer (JWT) authorization: oauth2
// $config->setAccessToken("YOUR_ACCESS_TOKEN");

$api = new HelloSignSDK\Api\TeamApi($config);

$teamId = "4fea99bfcf2b26bfccf6cea3e127fb8bb74d8d9c";

try {
    $result = $api->teamSubTeams($teamId);
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
| **team_id** | **string**| The id of the parent Team. | |
| **page** | **int**| Which page number of the SubTeam List to return. Defaults to `1`. | [optional] [default to 1] |
| **page_size** | **int**| Number of objects to be returned per page. Must be between `1` and `100`. Default is `20`. | [optional] [default to 20] |

### Return type

[**\HelloSignSDK\Model\TeamSubTeamsResponse**](../Model/TeamSubTeamsResponse.md)

### Authorization

[api_key](../../README.md#api_key), [oauth2](../../README.md#oauth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `teamUpdate()`

```php
teamUpdate($team_update_request): \HelloSignSDK\Model\TeamGetResponse
```

Update Team

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

$api = new HelloSignSDK\Api\TeamApi($config);

$data = new HelloSignSDK\Model\TeamUpdateRequest();
$data->setName("New Team Name");

try {
    $result = $api->teamUpdate($data);
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
