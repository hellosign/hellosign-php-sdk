# # SignatureRequestResponseData

An array of form field objects containing the name, value, and type of each textbox or checkmark field filled in by the signers.

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `api_id` | ```string``` |  The unique ID for this field.  |  |
| `signature_id` | ```string``` |  The ID of the signature to which this response is linked.  |  |
| `name` | ```string``` |  The name of the form field.  |  |
| `value` | ```string``` |  The value of the form field.  |  |
| `required` | ```bool``` |  A boolean value denoting if this field is required.  |  |
| `type` | ```string``` |  - `text`: A text input field - `checkbox`: A yes/no checkbox - `date_signed`: A date - `dropdown`: An input field for dropdowns - `initials`: An input field for initials - `radio`: An input field for radios - `signature`: A signature input field - `text-merge`: A text field that has default text set by the api - `checkbox-merge`: A checkbox field that has default value set by the api  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
