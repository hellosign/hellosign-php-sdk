# # SubCustomField

When used together with merge fields, `custom_fields` allows users to add pre-filled data to their signature requests.

Pre-filled data can be used with &quot;send-once&quot; signature requests by adding merge fields with `form_fields_per_document` or [Text Tags](https://app.hellosign.com/api/textTagsWalkthrough#TextTagIntro) while passing values back with `custom_fields` together in one API call.

For using pre-filled on repeatable signature requests, merge fields are added to templates in the Dropbox Sign UI or by calling [/template/create_embedded_draft](/api/reference/operation/templateCreateEmbeddedDraft) and then passing `custom_fields` on subsequent signature requests referencing that template.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `name`<sup>*_required_</sup> | ```string``` |  The name of a custom field. When working with pre-filled data, the custom field&#39;s name must have a matching merge field name or the field will remain empty on the document during signing.  |  |
| `editor` | ```string``` |  Used to create editable merge fields. When the value matches a role passed in with `signers`, that role can edit the data that was pre-filled to that field. This field is optional, but required when this custom field object is set to `required &#x3D; true`.<br><br>**Note**: Editable merge fields are only supported for single signer requests (or the first signer in ordered signature requests). If used when there are multiple signers in an unordered signature request, the editor value is ignored and the field won&#39;t be editable.  |  |
| `required` | ```bool``` |  Used to set an editable merge field when working with pre-filled data. When `true`, the custom field must specify a signer role in `editor`.  |  [default to false] |
| `value` | ```string``` |  The string that resolves (aka &quot;pre-fills&quot;) to the merge field on the final document(s) used for signing.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
