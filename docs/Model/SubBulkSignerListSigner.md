# # SubBulkSignerListSigner



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `role`<sup>*_required_</sup> | ```string``` |  Must match the single existing role in chosen Template(s). Currently only templates with a single role are supported. All signers must have the same `role` value.  |  |
| `name`<sup>*_required_</sup> | ```string``` |  The name of the signer.  |  |
| `email_address`<sup>*_required_</sup> | ```string``` |  The email address of the signer.  |  |
| `pin` | ```string``` |  The 4- to 12-character access code that will secure this signer&#39;s signature page.  |  |
| `sms_phone_number` | ```string``` |  An E.164 formatted phone number that will receive a code via SMS to access this signer&#39;s signature page.<br><br>**Note**: Not available in test mode and requires a Platinum plan or higher.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
