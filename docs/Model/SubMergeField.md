# # SubMergeField

The merge fields that can be placed on the template&#39;s document(s) by the user editing the template. These are typically fields that can be pre-populated by your application when using the resulting template to send a signature request. Each merge field object must have two parameters: name and type. Names must be unique and type can only be &quot;text&quot; or &quot;checkbox&quot;. Existing fields for removed merge fields will not be removed from the document, but will default to empty if no custom field is supplied with the signature request. To remove all merge fields, pass in an empty json array. For use in a POST request.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `name` | ```string``` |    |  |
| `type` | ```string``` |    |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
