# # SubSignatureRequestTemplateSigner



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `role`<sup>*_required_</sup> | ```string``` |  Must match an existing role in chosen Template(s). It&#39;s case-sensitive.  |  |
| `name`<sup>*_required_</sup> | ```string``` |  The name of the signer.  |  |
| `email_address`<sup>*_required_</sup> | ```string``` |  The email address of the signer.  |  |
| `pin` | ```string``` |  The 4- to 12-character access code that will secure this signer&#39;s signature page.  |  |
| `sms_phone_number` | ```string``` |  An E.164 formatted phone number.<br><br>**Note**: Not available in test mode and requires a Standard plan or higher.  |  |
| `sms_phone_number_type` | ```string``` |  Specifies the feature used with the `sms_phone_number`. Default `authentication`.<br><br>If `authentication`, signer is sent a verification code via SMS that is required to access the document.<br><br>If `delivery`, a link to complete the signature request is delivered via SMS (_and_ email).  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
