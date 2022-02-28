# # SubSigningOptions

This allows the requester to specify the types allowed for creating a signature.

**Note**: If `signing_options` are not defined in the request, the allowed types will default to those specified in the account settings.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `default_type`<sup>*_required_</sup> | ```string``` |  The default type shown (limited to the listed types)  |  |
| `draw` | ```bool``` |  Allows drawing the signature  |  [default to false] |
| `phone` | ```bool``` |  Allows using a smartphone to email the signature  |  [default to false] |
| `type` | ```bool``` |  Allows typing the signature  |  [default to false] |
| `upload` | ```bool``` |  Allows uploading the signature  |  [default to false] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
