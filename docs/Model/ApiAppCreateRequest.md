# # ApiAppCreateRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `domains`<sup>*_required_</sup> | ```string[]``` |  The domain names the ApiApp will be associated with.  |  |
| `name`<sup>*_required_</sup> | ```string``` |  The name you want to assign to the ApiApp.  |  |
| `callback_url` | ```string``` |  The URL at which the ApiApp should receive event callbacks.  |  |
| `custom_logo_file` | ```\SplFileObject``` |  An image file to use as a custom logo in embedded contexts. (Only applies to some API plans)  |  |
| `oauth` | [```\HelloSignSDK\Model\SubOAuth```](SubOAuth.md) |    |  |
| `options` | [```\HelloSignSDK\Model\SubOptions```](SubOptions.md) |    |  |
| `white_labeling_options` | [```\HelloSignSDK\Model\SubWhiteLabelingOptions```](SubWhiteLabelingOptions.md) |    |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
