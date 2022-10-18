# # SignatureRequestResponseSignatures

An array of signature objects, 1 for each signer.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `signature_id` | ```string``` |  Signature identifier.  |  |
| `signer_email_address` | ```string``` |  The email address of the signer.  |  |
| `signer_name` | ```string``` |  The name of the signer.  |  |
| `signer_role` | ```string``` |  The role of the signer.  |  |
| `order` | ```int``` |  If signer order is assigned this is the 0-based index for this signer.  |  |
| `status_code` | ```string``` |  The current status of the signature. eg: awaiting_signature, signed, declined.  |  |
| `decline_reason` | ```string``` |  The reason provided by the signer for declining the request.  |  |
| `signed_at` | ```int``` |  Time that the document was signed or null.  |  |
| `last_viewed_at` | ```int``` |  The time that the document was last viewed by this signer or null.  |  |
| `last_reminded_at` | ```int``` |  The time the last reminder email was sent to the signer or null.  |  |
| `has_pin` | ```bool``` |  Boolean to indicate whether this signature requires a PIN to access.  |  |
| `has_sms_auth` | ```bool``` |  Boolean to indicate whether this signature has SMS authentication enabled.  |  |
| `has_sms_delivery` | ```bool``` |  Boolean to indicate whether this signature has SMS delivery enabled.  |  |
| `sms_phone_number` | ```string``` |  The SMS phone number used for authentication or signature request delivery.  |  |
| `reassigned_by` | ```string``` |  Email address of original signer who reassigned to this signer.  |  |
| `reassignment_reason` | ```string``` |  Reason provided by original signer who reassigned to this signer.  |  |
| `reassigned_from` | ```string``` |  Previous signature identifier.  |  |
| `error` | ```string``` |  Error message pertaining to this signer, or null.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
