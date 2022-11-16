# # UnclaimedDraftCreateEmbeddedWithTemplateRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `client_id`<sup>*_required_</sup> | ```string``` |  Client id of the app used to create the draft. Used to apply the branding and callback url defined for the app.  |  |
| `requester_email_address`<sup>*_required_</sup> | ```string``` |  The email address of the user that should be designated as the requester of this draft.  |  |
| `template_ids`<sup>*_required_</sup> | ```string[]``` |  Use `template_ids` to create a SignatureRequest from one or more templates, in the order in which the templates will be used.  |  |
| `allow_decline` | ```bool``` |  Allows signers to decline to sign a document if `true`. Defaults to `false`.  |  [default to false] |
| `allow_reassign` | ```bool``` |  Allows signers to reassign their signature requests to other signers if set to `true`. Defaults to `false`.<br><br>**Note**: Only available for Premium plan and higher.  |  [default to false] |
| `ccs` | [```\HelloSignSDK\Model\SubCC[]```](SubCC.md) |  Add CC email recipients. Required when a CC role exists for the Template.  |  |
| `custom_fields` | [```\HelloSignSDK\Model\SubCustomField[]```](SubCustomField.md) |  An array defining values and options for custom fields. Required when a custom field exists in the Template.  |  |
| `editor_options` | [```\HelloSignSDK\Model\SubEditorOptions```](SubEditorOptions.md) |    |  |
| `field_options` | [```\HelloSignSDK\Model\SubFieldOptions```](SubFieldOptions.md) |    |  |
| `file` | ```\SplFileObject[]``` |  Use `file[]` to append additional files to the signature request being created from the template. Dropbox Sign will parse the files for [text tags](https://app.hellosign.com/api/textTagsWalkthrough) and append it to the signature request. Text tags for signers not on the template(s) will be ignored.<br><br>**file** or **file_url[]** is required, but not both.  |  |
| `file_url` | ```string[]``` |  Use file_url[] to append additional files to the signature request being created from the template. Dropbox Sign will download the file, then parse it for [text tags](https://app.hellosign.com/api/textTagsWalkthrough), and append to the signature request. Text tags for signers not on the template(s) will be ignored.<br><br>**file** or **file_url[]** is required, but not both.  |  |
| `force_signer_roles` | ```bool``` |  Provide users the ability to review/edit the template signer roles.  |  [default to false] |
| `force_subject_message` | ```bool``` |  Provide users the ability to review/edit the template subject and message.  |  [default to false] |
| `hold_request` | ```bool``` |  The request from this draft will not automatically send to signers post-claim if set to 1. Requester must [release](/api/reference/operation/signatureRequestReleaseHold/) the request from hold when ready to send. Defaults to `false`.  |  [default to false] |
| `is_for_embedded_signing` | ```bool``` |  The request created from this draft will also be signable in embedded mode if set to `true`. Defaults to `false`.  |  [default to false] |
| `message` | ```string``` |  The custom message in the email that will be sent to the signers.  |  |
| `metadata` | ```array<string,mixed>``` |  Key-value data that should be attached to the signature request. This metadata is included in all API responses and events involving the signature request. For example, use the metadata field to store a signer&#39;s order number for look up when receiving events for the signature request.<br><br>Each request can include up to 10 metadata keys (or 50 nested metadata keys), with key names up to 40 characters long and values up to 1000 characters long.  |  |
| `preview_only` | ```bool``` |  This allows the requester to enable the preview experience (i.e. does not allow the requester&#39;s end user to add any additional fields via the editor).<br><br>- `preview_only&#x3D;true`: Allows requesters to enable the preview only experience. - `preview_only&#x3D;false`: Allows requesters to disable the preview only experience.<br><br>**Note**: This parameter overwrites `show_preview&#x3D;1` (if set).  |  [default to false] |
| `requesting_redirect_url` | ```string``` |  The URL you want signers redirected to after they successfully request a signature.  |  |
| `show_preview` | ```bool``` |  This allows the requester to enable the editor/preview experience.<br><br>- `show_preview&#x3D;true`: Allows requesters to enable the editor/preview experience. - `show_preview&#x3D;false`: Allows requesters to disable the editor/preview experience.  |  [default to false] |
| `show_progress_stepper` | ```bool``` |  When only one step remains in the signature request process and this parameter is set to `false` then the progress stepper will be hidden.  |  [default to true] |
| `signers` | [```\HelloSignSDK\Model\SubUnclaimedDraftTemplateSigner[]```](SubUnclaimedDraftTemplateSigner.md) |  Add Signers to your Templated-based Signature Request.  |  |
| `signing_options` | [```\HelloSignSDK\Model\SubSigningOptions```](SubSigningOptions.md) |    |  |
| `signing_redirect_url` | ```string``` |  The URL you want signers redirected to after they successfully sign.  |  |
| `skip_me_now` | ```bool``` |  Disables the &quot;Me (Now)&quot; option for the person preparing the document. Does not work with type `send_document`. Defaults to `false`.  |  [default to false] |
| `subject` | ```string``` |  The subject in the email that will be sent to the signers.  |  |
| `test_mode` | ```bool``` |  Whether this is a test, the signature request created from this draft will not be legally binding if set to `true`. Defaults to `false`.  |  [default to false] |
| `title` | ```string``` |  The title you want to assign to the SignatureRequest.  |  |
| `populate_auto_fill_fields` | ```bool``` |  Controls whether [auto fill fields](https://faq.hellosign.com/hc/en-us/articles/360051467511-Auto-Fill-Fields) can automatically populate a signer&#39;s information during signing.<br><br>⚠️ **Note** ⚠️: Keep your signer&#39;s information safe by ensuring that the _signer on your signature request is the intended party_ before using this feature.  |  [default to false] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
