# # UnclaimedDraftCreateEmbeddedWithTemplateRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `client_id`<sup>*_required_</sup> | ```string``` |  Client id of the app you&#39;re using to create this draft. Visit our [embedded page](https://app.hellosign.com/api/embeddedSigningWalkthrough) to learn more about this parameter.  |  |
| `requester_email_address`<sup>*_required_</sup> | ```string``` |  The email address of the user that should be designated as the requester of this draft, if the draft type is `request_signature`.  |  |
| `template_ids`<sup>*_required_</sup> | ```string[]``` |  Use `template_ids` to create a SignatureRequest from one or more templates, in the order in which the templates will be used.  |  |
| `allow_decline` | ```bool``` |  Allows signers to decline to sign a document if `true`. Defaults to `false`.  |  [default to false] |
| `allow_reassign` | ```bool``` |  Allows signers to reassign their signature requests to other signers if set to `true`. Defaults to `false`.<br><br>**Note**: Only available for Gold plan and higher.  |  [default to false] |
| `ccs` | [```\HelloSignSDK\Model\SubCC[]```](SubCC.md) |  Add CC email recipients. Required when a CC role exists for the Template.  |  |
| `custom_fields` | [```\HelloSignSDK\Model\SubCustomField[]```](SubCustomField.md) |  An array defining values and options for custom fields. Required when defining when a custom field exists in the Template.  |  |
| `editor_options` | [```\HelloSignSDK\Model\SubEditorOptions```](SubEditorOptions.md) |    |  |
| `field_options` | [```\HelloSignSDK\Model\SubFieldOptions```](SubFieldOptions.md) |    |  |
| `file` | ```\SplFileObject[]``` |  **file** or **file_url** is required, but not both.<br><br>Append additional files to the signature request. HelloSign will parse the files for [text tags](https://app.hellosign.com/api/textTagsWalkthrough). Text tags for signers not on the template(s) will be ignored.<br><br>Use `file[]` to pass the uploaded file(s).<br><br>Currently we only support use of either the `file[]` parameter or `file_url[]` parameter, not both.  |  |
| `file_url` | ```string[]``` |  **file** or **file_url** is required, but not both.<br><br>Append additional files to the signature request. HelloSign will parse the files for [text tags](https://app.hellosign.com/api/textTagsWalkthrough). Text tags for signers not on the template(s) will be ignored.<br><br>Use `file_url[]` to have HelloSign download the file(s).<br><br>Currently we only support use of either the `file[]` parameter or `file_url[]` parameter, not both.  |  |
| `hold_request` | ```bool``` |  The request from this draft will not automatically send to signers post-claim if set to 1. Requester must [release](https://app.hellosign.com/api/reference#release_on-hold_signature_request) the request from hold when ready to send. Defaults to `false`.  |  [default to false] |
| `is_for_embedded_signing` | ```bool``` |  The request created from this draft will also be signable in embedded mode if set to `true`. Defaults to `false`.  |  [default to false] |
| `message` | ```string``` |  The custom message in the email that will be sent to the signers.  |  |
| `metadata` | ```array<string,mixed>``` |  Key-value data that should be attached to the signature request. This metadata is included in all API responses and events involving the signature request. For example, use the metadata field to store a signer&#39;s order number for look up when receiving events for the signature request.<br><br>Each request can include up to 10 metadata keys, with key names up to 40 characters long and values up to 1000 characters long.  |  |
| `preview_only` | ```bool``` |  This allows the requester to enable the preview experience experience.<br><br>- `preview_only&#x3D;true`: Allows requesters to enable the preview only experience. - `preview_only&#x3D;false`: Allows requesters to disable the preview only experience.<br><br>**Note**: This parameter overwrites `show_preview&#x3D;1` (if set).  |  [default to false] |
| `requesting_redirect_url` | ```string``` |  The URL you want signers redirected to after they successfully request a signature.  |  |
| `show_preview` | ```bool``` |  This allows the requester to enable the editor/preview experience.<br><br>- `show_preview&#x3D;true`: Allows requesters to enable the editor/preview experience. - `show_preview&#x3D;false`: Allows requesters to disable the editor/preview experience.  |  [default to false] |
| `signers` | [```\HelloSignSDK\Model\SubUnclaimedDraftEmbeddedTemplateSigner[]```](SubUnclaimedDraftEmbeddedTemplateSigner.md) |  Add Signers to your Templated-based Signature Request.  |  |
| `signing_options` | [```\HelloSignSDK\Model\SubSigningOptions```](SubSigningOptions.md) |    |  |
| `signing_redirect_url` | ```string``` |  The URL you want signers redirected to after they successfully sign.  |  |
| `skip_me_now` | ```bool``` |  Disables the &quot;Me (Now)&quot; option for the person preparing the document. Does not work with type `send_document`. Defaults to `false`.  |  [default to false] |
| `subject` | ```string``` |  The subject in the email that will be sent to the signers.  |  |
| `test_mode` | ```bool``` |  Whether this is a test, the signature request created from this draft will not be legally binding if set to `true`. Defaults to `false`.  |  [default to false] |
| `title` | ```string``` |  The title you want to assign to the SignatureRequest.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
