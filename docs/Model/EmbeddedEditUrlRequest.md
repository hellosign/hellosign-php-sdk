# # EmbeddedEditUrlRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `allow_edit_ccs` | ```bool``` |  This allows the requester to enable/disable to add or change CC roles when editing the template.  |  [default to false] |
| `cc_roles` | ```string[]``` |  The CC roles that must be assigned when using the template to send a signature request. To remove all CC roles, pass in a single role with no name. For use in a POST request.  |  |
| `editor_options` | [```\HelloSignSDK\Model\SubEditorOptions```](SubEditorOptions.md) |    |  |
| `force_signer_roles` | ```bool``` |  Provide users the ability to review/edit the template signer roles.  |  [default to false] |
| `force_subject_message` | ```bool``` |  Provide users the ability to review/edit the template subject and message.  |  [default to false] |
| `merge_fields` | [```\HelloSignSDK\Model\SubMergeField[]```](SubMergeField.md) |  Add additional merge fields to the template, which can be used used to pre-fill data by passing values into signature requests made with that template.<br><br>Remove all merge fields on the template by passing an empty array `[]`.  |  |
| `preview_only` | ```bool``` |  This allows the requester to enable the preview experience (i.e. does not allow the requester&#39;s end user to add any additional fields via the editor).<br><br>**Note**: This parameter overwrites `show_preview&#x3D;true` (if set).  |  [default to false] |
| `show_preview` | ```bool``` |  This allows the requester to enable the editor/preview experience.  |  [default to false] |
| `show_progress_stepper` | ```bool``` |  When only one step remains in the signature request process and this parameter is set to `false` then the progress stepper will be hidden.  |  [default to true] |
| `test_mode` | ```bool``` |  Whether this is a test, locked templates will only be available for editing if this is set to `true`. Defaults to `false`.  |  [default to false] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
