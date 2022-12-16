# # TemplateCreateEmbeddedDraftRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `client_id`<sup>*_required_</sup> | ```string``` |  Client id of the app you&#39;re using to create this draft. Used to apply the branding and callback url defined for the app.  |  |
| `file` | ```\SplFileObject[]``` |  Use `file[]` to indicate the uploaded file(s) to send for signature.<br><br>This endpoint requires either **file** or **file_url[]**, but not both.  |  |
| `file_url` | ```string[]``` |  Use `file_url[]` to have Dropbox Sign download the file(s) to send for signature.<br><br>This endpoint requires either **file** or **file_url[]**, but not both.  |  |
| `allow_ccs` | ```bool``` |  This allows the requester to specify whether the user is allowed to provide email addresses to CC when creating a template.  |  [default to true] |
| `allow_reassign` | ```bool``` |  Allows signers to reassign their signature requests to other signers if set to `true`. Defaults to `false`.<br><br>**Note**: Only available for Premium plan and higher.  |  [default to false] |
| `attachments` | [```\HelloSignSDK\Model\SubAttachment[]```](SubAttachment.md) |  A list describing the attachments  |  |
| `cc_roles` | ```string[]``` |  The CC roles that must be assigned when using the template to send a signature request  |  |
| `editor_options` | [```\HelloSignSDK\Model\SubEditorOptions```](SubEditorOptions.md) |    |  |
| `field_options` | [```\HelloSignSDK\Model\SubFieldOptions```](SubFieldOptions.md) |    |  |
| `force_signer_roles` | ```bool``` |  Provide users the ability to review/edit the template signer roles.  |  [default to false] |
| `force_subject_message` | ```bool``` |  Provide users the ability to review/edit the template subject and message.  |  [default to false] |
| `form_field_groups` | [```\HelloSignSDK\Model\SubFormFieldGroup[]```](SubFormFieldGroup.md) |  Group information for fields defined in `form_fields_per_document`. String-indexed JSON array with `group_label` and `requirement` keys. `form_fields_per_document` must contain fields referencing a group defined in `form_field_groups`.  |  |
| `form_field_rules` | [```\HelloSignSDK\Model\SubFormFieldRule[]```](SubFormFieldRule.md) |  Conditional Logic rules for fields defined in `form_fields_per_document`.  |  |
| `form_fields_per_document` | [```\HelloSignSDK\Model\SubFormFieldsPerDocumentBase[]```](SubFormFieldsPerDocumentBase.md) |  The fields that should appear on the document, expressed as an array of objects. (We&#39;re currently fixing a bug where this property only accepts a two-dimensional array. You can read about it here: &lt;a href&#x3D;&quot;/docs/placing-fields/form-fields-per-document&quot; target&#x3D;&quot;_blank&quot;&gt;Using Form Fields per Document&lt;/a&gt;.)<br><br>**NOTE**: Fields like **text**, **dropdown**, **checkbox**, **radio**, and **hyperlink** have additional required and optional parameters. Check out the list of [additional parameters](/api/reference/constants/#form-fields-per-document) for these field types.<br><br>* Text Field use `SubFormFieldsPerDocumentText`<br>* Dropdown Field use `SubFormFieldsPerDocumentDropdown`<br>* Hyperlink Field use `SubFormFieldsPerDocumentHyperlink`<br>* Checkbox Field use `SubFormFieldsPerDocumentCheckbox`<br>* Radio Field use `SubFormFieldsPerDocumentRadio`<br>* Signature Field use `SubFormFieldsPerDocumentSignature`<br>* Date Signed Field use `SubFormFieldsPerDocumentDateSigned`<br>* Initials Field use `SubFormFieldsPerDocumentInitials`<br>* Text Merge Field use `SubFormFieldsPerDocumentTextMerge`<br>* Checkbox Merge Field use `SubFormFieldsPerDocumentCheckboxMerge`  |  |
| `merge_fields` | [```\HelloSignSDK\Model\SubMergeField[]```](SubMergeField.md) |  Add merge fields to the template. Merge fields are placed by the user creating the template and used to pre-fill data by passing values into signature requests with the `custom_fields` parameter. If the signature request using that template *does not* pass a value into a merge field, then an empty field remains in the document.  |  |
| `message` | ```string``` |  The default template email message.  |  |
| `metadata` | ```array<string,mixed>``` |  Key-value data that should be attached to the signature request. This metadata is included in all API responses and events involving the signature request. For example, use the metadata field to store a signer&#39;s order number for look up when receiving events for the signature request.<br><br>Each request can include up to 10 metadata keys (or 50 nested metadata keys), with key names up to 40 characters long and values up to 1000 characters long.  |  |
| `show_preview` | ```bool``` |  This allows the requester to enable the editor/preview experience.<br><br>- `show_preview&#x3D;true`: Allows requesters to enable the editor/preview experience. - `show_preview&#x3D;false`: Allows requesters to disable the editor/preview experience.  |  [default to false] |
| `show_progress_stepper` | ```bool``` |  When only one step remains in the signature request process and this parameter is set to `false` then the progress stepper will be hidden.  |  [default to true] |
| `signer_roles` | [```\HelloSignSDK\Model\SubTemplateRole[]```](SubTemplateRole.md) |  An array of the designated signer roles that must be specified when sending a SignatureRequest using this Template.  |  |
| `skip_me_now` | ```bool``` |  Disables the &quot;Me (Now)&quot; option for the person preparing the document. Does not work with type `send_document`. Defaults to `false`.  |  [default to false] |
| `subject` | ```string``` |  The template title (alias).  |  |
| `test_mode` | ```bool``` |  Whether this is a test, the signature request created from this draft will not be legally binding if set to `true`. Defaults to `false`.  |  [default to false] |
| `title` | ```string``` |  The title you want to assign to the SignatureRequest.  |  |
| `use_preexisting_fields` | ```bool``` |  Enable the detection of predefined PDF fields by setting the `use_preexisting_fields` to `true` (defaults to disabled, or `false`).  |  [default to false] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
