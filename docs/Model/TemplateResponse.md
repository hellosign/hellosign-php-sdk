# # TemplateResponse



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `template_id` | ```string``` |  The id of the Template.  |  |
| `title` | ```string``` |  The title of the Template. This will also be the default subject of the message sent to signers when using this Template to send a SignatureRequest. This can be overridden when sending the SignatureRequest.  |  |
| `message` | ```string``` |  The default message that will be sent to signers when using this Template to send a SignatureRequest. This can be overridden when sending the SignatureRequest.  |  |
| `updated_at` | ```int``` |  Time the template was last updated.  |  |
| `is_embedded` | ```bool``` |  `true` if this template was created using an embedded flow, `false` if it was created on our website.  |  |
| `is_creator` | ```bool``` |  `true` if you are the owner of this template, `false` if it&#39;s been shared with you by a team member.  |  |
| `can_edit` | ```bool``` |  Indicates whether edit rights have been granted to you by the owner (always `true` if that&#39;s you).  |  |
| `is_locked` | ```bool``` |  `true` if you exceed Template quota; these can only be used in test mode. `false` if the template is included with the Template quota; these can be used at any time.  |  |
| `metadata` | ```array``` |  The metadata attached to the template.  |  |
| `signer_roles` | [```\HelloSignSDK\Model\TemplateResponseSignerRole[]```](TemplateResponseSignerRole.md) |    |  |
| `cc_roles` | [```\HelloSignSDK\Model\TemplateResponseCCRole[]```](TemplateResponseCCRole.md) |    |  |
| `documents` | [```\HelloSignSDK\Model\TemplateResponseDocument[]```](TemplateResponseDocument.md) |    |  |
| `custom_fields` | [```\HelloSignSDK\Model\TemplateResponseCustomField[]```](TemplateResponseCustomField.md) |    |  |
| `accounts` | [```\HelloSignSDK\Model\TemplateResponseAccount[]```](TemplateResponseAccount.md) |    |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
