# # SignatureRequestResponse

Contains information about a signature request.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `test_mode` | ```bool``` |  Whether this is a test signature request. Test requests have no legal value. Defaults to `false`.  |  [default to false] |
| `signature_request_id` | ```string``` |  The id of the SignatureRequest.  |  |
| `requester_email_address` | ```string``` |  The email address of the initiator of the SignatureRequest.  |  |
| `title` | ```string``` |  The title the specified Account uses for the SignatureRequest.  |  |
| `original_title` | ```string``` |  Default Label for account.  |  |
| `subject` | ```string``` |  The subject in the email that was initially sent to the signers.  |  |
| `message` | ```string``` |  The custom message in the email that was initially sent to the signers.  |  |
| `metadata` | ```array``` |  The metadata attached to the signature request.  |  |
| `created_at` | ```int``` |  Time the signature request was created.  |  |
| `expires_at` | ```int``` |  The time when the signature request will expire pending signatures.  |  |
| `is_complete` | ```bool``` |  Whether or not the SignatureRequest has been fully executed by all signers.  |  |
| `is_declined` | ```bool``` |  Whether or not the SignatureRequest has been declined by a signer.  |  |
| `has_error` | ```bool``` |  Whether or not an error occurred (either during the creation of the SignatureRequest or during one of the signings).  |  |
| `files_url` | ```string``` |  The URL where a copy of the request&#39;s documents can be downloaded.  |  |
| `signing_url` | ```string``` |  The URL where a signer, after authenticating, can sign the documents. This should only be used by users with existing Dropbox Sign accounts as they will be required to log in before signing.  |  |
| `details_url` | ```string``` |  The URL where the requester and the signers can view the current status of the SignatureRequest.  |  |
| `cc_email_addresses` | ```string[]``` |  A list of email addresses that were CCed on the SignatureRequest. They will receive a copy of the final PDF once all the signers have signed.  |  |
| `signing_redirect_url` | ```string``` |  The URL you want the signer redirected to after they successfully sign.  |  |
| `template_ids` | ```string[]``` |  Templates IDs used in this SignatureRequest (if any).  |  |
| `custom_fields` | [```\HelloSignSDK\Model\SignatureRequestResponseCustomFieldBase[]```](SignatureRequestResponseCustomFieldBase.md) |  An array of Custom Field objects containing the name and type of each custom field.<br><br>* Text Field uses `SignatureRequestResponseCustomFieldText`<br>* Checkbox Field uses `SignatureRequestResponseCustomFieldCheckbox`  |  |
| `attachments` | [```\HelloSignSDK\Model\SignatureRequestResponseAttachment[]```](SignatureRequestResponseAttachment.md) |  Signer attachments.  |  |
| `response_data` | [```\HelloSignSDK\Model\SignatureRequestResponseDataBase[]```](SignatureRequestResponseDataBase.md) |  An array of form field objects containing the name, value, and type of each textbox or checkmark field filled in by the signers.  |  |
| `signatures` | [```\HelloSignSDK\Model\SignatureRequestResponseSignatures[]```](SignatureRequestResponseSignatures.md) |  An array of signature objects, 1 for each signer.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
