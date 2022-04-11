# # EmbeddedEditUrlRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `allow_edit_ccs` | ```bool``` |  This allows the requester to enable/disable to add or change CC roles when editing the template.  |  [default to false] |
| `cc_roles` | ```string[]``` |  The CC roles that must be assigned when using the template to send a signature request. To remove all CC roles, pass in a single role with no name. For use in a POST request.  |  |
| `editor_options` | [```\HelloSignSDK\Model\SubEditorOptions```](SubEditorOptions.md) |    |  |
| `force_signer_roles` | ```bool``` |  Provide users the ability to review/edit the template signer roles.  |  [default to false] |
| `force_subject_message` | ```bool``` |  Provide users the ability to review/edit the template subject and message.  |  [default to false] |
| `merge_fields` | [```\HelloSignSDK\Model\SubMergeField[]```](SubMergeField.md) |    |  |
| `preview_only` | ```bool``` |  This allows the requester to enable the preview experience (i.e. does not allow the requester&#39;s end user to add any additional fields via the editor).<br><br>**Note**: This parameter overwrites `show_preview&#x3D;true` (if set).  |  [default to false] |
| `show_preview` | ```bool``` |  This allows the requester to enable the editor/preview experience.  |  [default to false] |
| `show_progress_stepper` | ```bool``` |  When only one step remains in the signature request process and this parameter is set to `false` then the progress stepper will be hidden.  |  [default to true] |
| `skip_signer_roles` | ```bool``` |  If signer roles are already provided, the user will not be prompted to edit them.<br><br>**Note**: this parameter will be deprecated in May 2020 and skipping the signer roles screen will become the default behavior. To enforce showing the signer roles screen, use the `force_signer_roles` parameter.  |  [default to false] |
| `skip_subject_message` | ```bool``` |  If the subject and message has already been provided, the user will not be prompted to edit them.<br><br>**Note**: this parameter will be deprecated in May 2020 and skipping the subject message screen will become the default behavior. To enforce showing the subject message screen, use the `force_subject_message` parameter.  |  [default to false] |
| `test_mode` | ```bool``` |  Whether this is a test, locked templates will only be available for editing if this is set to `true`. Defaults to `false`.  |  [default to false] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
