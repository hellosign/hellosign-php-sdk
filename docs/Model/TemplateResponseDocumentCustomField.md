# # TemplateResponseDocumentCustomField

An array of the designated CC roles that must be specified when sending a SignatureRequest using this Template.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `name` | ```string``` |  The name of the Custom Field.  |  |
| `type` | ```string``` |  The type of this Custom Field. Only `text` and `checkbox` are currently supported.  |  |
| `x` | ```int``` |  The horizontal offset in pixels for this form field.  |  |
| `y` | ```int``` |  The vertical offset in pixels for this form field.  |  |
| `width` | ```int``` |  The width in pixels of this form field.  |  |
| `height` | ```int``` |  The height in pixels of this form field.  |  |
| `required` | ```bool``` |  Boolean showing whether or not this field is required.  |  |
| `group` | ```string``` |  The name of the group this field is in. If this field is not a group, this defaults to `null`.  |  |
| `avg_text_length` | [```\HelloSignSDK\Model\TemplateResponseDocumentCustomFieldAvgTextLength```](TemplateResponseDocumentCustomFieldAvgTextLength.md) |    |  |
| `named_form_fields` | ```array``` |  Use `form_fields` under the `documents` array instead.  |  |
| `reusable_form_id` | ```string``` |    |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
