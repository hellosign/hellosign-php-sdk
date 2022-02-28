# # ApiAppResponseOAuth

An object describing the app&#39;s OAuth properties, or null if OAuth is not configured for the app.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `callback_url` | ```string``` |  The app&#39;s OAuth callback URL.  |  |
| `secret` | ```string``` |  The app&#39;s OAuth secret, or null if the app does not belong to user.  |  |
| `scopes` | ```string[]``` |  Array of OAuth scopes used by the app.  |  |
| `charges_users` | ```bool``` |  Boolean indicating whether the app owner or the account granting permission is billed for OAuth requests.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
