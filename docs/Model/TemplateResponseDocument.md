# # TemplateResponseDocument



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `name` | ```string``` |  Name of the associated file.  |  |
| `index` | ```int``` |  Document ordering, the lowest index is displayed first and the highest last (0-based indexing).  |  |
| `field_groups` | [```\HelloSignSDK\Model\TemplateResponseDocumentFieldGroup[]```](TemplateResponseDocumentFieldGroup.md) |  An array of Form Field Group objects.  |  |
| `form_fields` | [```\HelloSignSDK\Model\TemplateResponseDocumentFormField[]```](TemplateResponseDocumentFormField.md) |  An array of Form Field objects containing the name and type of each named textbox and checkmark field.  |  |
| `custom_fields` | [```\HelloSignSDK\Model\TemplateResponseDocumentCustomField[]```](TemplateResponseDocumentCustomField.md) |  An array of Document Custom Field objects.  |  |
| `static_fields` | [```\HelloSignSDK\Model\TemplateResponseDocumentStaticField[]```](TemplateResponseDocumentStaticField.md) |  An array describing static overlay fields. &lt;b&gt;Note&lt;/b&gt; only available for certain subscriptions.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
