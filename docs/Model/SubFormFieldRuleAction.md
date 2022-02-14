# # SubFormFieldRuleAction



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `hidden`<sup>*_required_</sup> | ```bool``` |  `true` to hide the target field when rule is satisfied, otherwise `false`.  |  |
| `type`<sup>*_required_</sup> | ```string``` |    |  |
| `field_id` | ```string``` |  **field_id** or **group_id** is required, but not both.<br><br>Must reference the `api_id` of an existing field defined within `form_fields_per_document`.<br><br>Cannot use with `group_id`. Trigger and action fields must belong to the same signer.  |  |
| `group_id` | ```string``` |  **group_id** or **field_id** is required, but not both.<br><br>Must reference the ID of an existing group defined within `form_field_groups`.<br><br>Cannot use with `field_id`. Trigger and action fields and groups must belong to the same signer.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
