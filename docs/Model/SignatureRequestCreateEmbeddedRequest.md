# # SignatureRequestCreateEmbeddedRequest

Calls SignatureRequestSend in controller

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `client_id`<sup>*_required_</sup> | ```string``` |  Client id of the app you&#39;re using to create this embedded signature request. Visit our [embedded page](https://app.hellosign.com/api/embeddedSigningWalkthrough) to learn more about this parameter.  |  |
| `file` | ```\SplFileObject[]``` |  **file** or **file_url** is required, but not both.<br><br>Use `file[]` to indicate the uploaded file(s) to send for signature.<br><br>Currently we only support use of either the `file[]` parameter or `file_url[]` parameter, not both.  |  |
| `file_url` | ```string[]``` |  **file_url** or **file** is required, but not both.<br><br>Use `file_url[]` to have HelloSign download the file(s) to send for signature.<br><br>Currently we only support use of either the `file[]` parameter or `file_url[]` parameter, not both.  |  |
| `allow_decline` | ```bool``` |  Allows signers to decline to sign a document if `true`. Defaults to `false`.  |  [default to false] |
| `allow_reassign` | ```bool``` |  Allows signers to reassign their signature requests to other signers if set to `true`. Defaults to `false`.<br><br>**Note**: Only available for Gold plan and higher.  |  [default to false] |
| `attachments` | [```\HelloSignSDK\Model\SubAttachment[]```](SubAttachment.md) |    |  |
| `cc_email_addresses` | ```string[]``` |  The email addresses that should be CCed.  |  |
| `custom_fields` | [```\HelloSignSDK\Model\SubCustomField[]```](SubCustomField.md) |  An array defining values and options for custom fields. Required when defining pre-set values in `form_fields_per_document` or [Text Tags](https://app.hellosign.com/api/textTagsWalkthrough#TextTagIntro).  |  |
| `field_options` | [```\HelloSignSDK\Model\SubFieldOptions```](SubFieldOptions.md) |    |  |
| `form_field_groups` | [```\HelloSignSDK\Model\SubFormFieldGroup[]```](SubFormFieldGroup.md) |  Group information for fields defined in `form_fields_per_document`. String-indexed JSON array with `group_label` and `requirement` keys. `form_fields_per_document` must contain fields referencing a group defined in `form_field_groups`.  |  |
| `form_field_rules` | [```\HelloSignSDK\Model\SubFormFieldRule[]```](SubFormFieldRule.md) |  Conditional Logic rules for fields defined in `form_fields_per_document`.  |  |
| `form_fields_per_document` | [```\HelloSignSDK\Model\SubFormFieldsPerDocumentBase[][]```](SubFormFieldsPerDocumentBase.md) |  The fields that should appear on the document, expressed as a 2-dimensional JSON array serialized to a string. The main array represents documents, with each containing an array of form fields. One document array is required for each file provided by the `file[]` parameter. In the case of a file with no fields, an empty list must be specified.<br><br>**NOTE**: Fields like **text**, **dropdown**, **checkbox**, **radio**, and **hyperlink** have additional required and optional parameters. Check out the list of [additional parameters](https://app.hellosign.com/api/reference#FormFieldsPerDocument) for these field types.<br><br>* Text Field use `SubFormFieldsPerDocumentText`<br>* Dropdown Field use `SubFormFieldsPerDocumentDropdown`<br>* Hyperlink Field use `SubFormFieldsPerDocumentHyperlink`<br>* Checkbox Field use `SubFormFieldsPerDocumentCheckbox`<br>* Radio Field use `SubFormFieldsPerDocumentRadio`<br>* Signature Field use `SubFormFieldsPerDocumentSignature`<br>* Date Signed Field use `SubFormFieldsPerDocumentDateSigned`<br>* Initials Field use `SubFormFieldsPerDocumentInitials`<br>* Text Merge Field use `SubFormFieldsPerDocumentTextMerge`<br>* Checkbox Merge Field use `SubFormFieldsPerDocumentCheckboxMerge`  |  |
| `message` | ```string``` |  The custom message in the email that will be sent to the signers.  |  |
| `metadata` | ```array<string,mixed>``` |  Key-value data that should be attached to the signature request. This metadata is included in all API responses and events involving the signature request. For example, use the metadata field to store a signer&#39;s order number for look up when receiving events for the signature request.<br><br>Each request can include up to 10 metadata keys, with key names up to 40 characters long and values up to 1000 characters long.  |  |
| `signers` | [```\HelloSignSDK\Model\SubSignatureRequestSigner[]```](SubSignatureRequestSigner.md) |  Add Signers to your Signature Request.  |  |
| `signing_options` | [```\HelloSignSDK\Model\SubSigningOptions```](SubSigningOptions.md) |    |  |
| `subject` | ```string``` |  The subject in the email that will be sent to the signers.  |  |
| `test_mode` | ```bool``` |  Whether this is a test, the signature request will not be legally binding if set to `true`. Defaults to `false`.  |  [default to false] |
| `title` | ```string``` |  The title you want to assign to the SignatureRequest.  |  |
| `use_text_tags` | ```bool``` |  Send with a value of `true` if you wish to enable [Text Tags](https://app.hellosign.com/api/textTagsWalkthrough#TextTagIntro) parsing in your document. Defaults to disabled, or `false`.  |  [default to false] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
