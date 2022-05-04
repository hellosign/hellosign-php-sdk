# # EventCallbackRequestEvent

Basic information about the event that occurred.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `event_time`<sup>*_required_</sup> | ```string``` |  Time the event was created (using Unix time).  |  |
| `event_type`<sup>*_required_</sup> | ```string``` |  Type of callback event that was triggered.  |  |
| `event_hash`<sup>*_required_</sup> | ```string``` |  Generated hash used to verify source of event data.  |  |
| `event_metadata`<sup>*_required_</sup> | [```\HelloSignSDK\Model\EventCallbackRequestEventMetadata```](EventCallbackRequestEventMetadata.md) |    |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
