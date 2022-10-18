# # SignatureRequestUpdateRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `signature_id`<sup>*_required_</sup> | ```string``` |  The signature ID for the recipient.  |  |
| `email_address` | ```string``` |  The new email address for the recipient.<br><br>**NOTE**: Optional if `name` is provided.  |  |
| `name` | ```string``` |  The new name for the recipient.<br><br>**NOTE**: Optional if `email_address` is provided.  |  |
| `expires_at` | ```int``` |  _t__SignatureRequestUpdate::EXPIRES_AT  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
