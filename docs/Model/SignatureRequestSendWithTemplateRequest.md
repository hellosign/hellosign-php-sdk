# # SignatureRequestSendWithTemplateRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `template_ids`<sup>*_required_</sup> | ```string[]``` |  Use `template_ids` to create a SignatureRequest from one or more templates, in the order in which the template will be used.  |  |
| `signers`<sup>*_required_</sup> | [```\HelloSignSDK\Model\SubSignatureRequestTemplateSigner[]```](SubSignatureRequestTemplateSigner.md) |  Add Signers to your Templated-based Signature Request.  |  |
| `allow_decline` | ```bool``` |  Allows signers to decline to sign a document if `true`. Defaults to `false`.  |  [default to false] |
| `ccs` | [```\HelloSignSDK\Model\SubCC[]```](SubCC.md) |  Add CC email recipients. Required when a CC role exists for the Template.  |  |
| `client_id` | ```string``` |  Client id of the app to associate with the signature request. Used to apply the branding and callback url defined for the app.  |  |
| `custom_fields` | [```\HelloSignSDK\Model\SubCustomField[]```](SubCustomField.md) |  An array defining values and options for custom fields. Required when a custom field exists in the Template.  |  |
| `file` | ```\SplFileObject[]``` |  Use `file[]` to indicate the uploaded file(s) to send for signature.<br><br>This endpoint requires either **file** or **file_url[]**, but not both.  |  |
| `file_url` | ```string[]``` |  Use `file_url[]` to have Dropbox Sign download the file(s) to send for signature.<br><br>This endpoint requires either **file** or **file_url[]**, but not both.  |  |
| `is_qualified_signature` | ```bool``` |  Send with a value of `true` if you wish to enable [Qualified Electronic Signatures](https://www.hellosign.com/features/qualified-electronic-signatures) (QES), which requires a face-to-face call to verify the signer&#39;s identity.&lt;br&gt;<br>**Note**: QES is only available on the Premium API plan as an add-on purchase. Cannot be used in `test_mode`. Only works on requests with one signer.  |  [default to false] |
| `message` | ```string``` |  The custom message in the email that will be sent to the signers.  |  |
| `metadata` | ```array<string,mixed>``` |  Key-value data that should be attached to the signature request. This metadata is included in all API responses and events involving the signature request. For example, use the metadata field to store a signer&#39;s order number for look up when receiving events for the signature request.<br><br>Each request can include up to 10 metadata keys (or 50 nested metadata keys), with key names up to 40 characters long and values up to 1000 characters long.  |  |
| `signing_options` | [```\HelloSignSDK\Model\SubSigningOptions```](SubSigningOptions.md) |    |  |
| `signing_redirect_url` | ```string``` |  The URL you want signers redirected to after they successfully sign.  |  |
| `subject` | ```string``` |  The subject in the email that will be sent to the signers.  |  |
| `test_mode` | ```bool``` |  Whether this is a test, the signature request will not be legally binding if set to `true`. Defaults to `false`.  |  [default to false] |
| `title` | ```string``` |  The title you want to assign to the SignatureRequest.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
