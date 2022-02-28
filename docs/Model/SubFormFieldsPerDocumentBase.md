# # SubFormFieldsPerDocumentBase

The fields that should appear on the document, expressed as a 2-dimensional JSON array serialized to a string. The main array represents documents, with each containing an array of form fields. One document array is required for each file provided by the `file[]` parameter. In the case of a file with no fields, an empty list must be specified.

**NOTE**: Fields like **text**, **dropdown**, **checkbox**, **radio**, and **hyperlink** have additional required and optional parameters. Check out the list of [additional parameters](https://app.hellosign.com/api/reference#FormFieldsPerDocument) for these field types.

* Text Field use `SubFormFieldsPerDocumentText`
* Dropdown Field use `SubFormFieldsPerDocumentDropdown`
* Hyperlink Field use `SubFormFieldsPerDocumentHyperlink`
* Checkbox Field use `SubFormFieldsPerDocumentCheckbox`
* Radio Field use `SubFormFieldsPerDocumentRadio`
* Signature Field use `SubFormFieldsPerDocumentSignature`
* Date Signed Field use `SubFormFieldsPerDocumentDateSigned`
* Initials Field use `SubFormFieldsPerDocumentInitials`
* Text Merge Field use `SubFormFieldsPerDocumentTextMerge`
* Checkbox Merge Field use `SubFormFieldsPerDocumentCheckboxMerge`

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `height`<sup>*_required_</sup> | ```int``` |  Size of the field in pixels.  |  |
| `signer`<sup>*_required_</sup> | ```string``` |  Signer index identified by the offset `%i%` in the `signers[%i%]` parameter, indicating which signer should fill out the field. If your type is `text-merge` you can set this to `sender`, so the field is non-editable by any signer.  |  |
| `type`<sup>*_required_</sup> | ```string``` |    |  |
| `width`<sup>*_required_</sup> | ```int``` |  Size of the field in pixels.  |  |
| `x`<sup>*_required_</sup> | ```int``` |  Location coordinates of the field in pixels.  |  |
| `y`<sup>*_required_</sup> | ```int``` |  Location coordinates of the field in pixels.  |  |
| `api_id` | ```string``` |  An identifier for the field that is unique across all documents in the request.  |  |
| `name` | ```string``` |  Display name for the field.  |  |
| `page` | ```int``` |  Page in the document where the field should be placed (requires documents be PDF files).<br><br>- When the page number parameter is supplied, the API will use the new coordinate system. - Check out the differences between both [coordinate systems](https://faq.hellosign.com/hc/en-us/articles/217115577) and how to use them.  |  |
| `required` | ```bool``` |  Whether this field is required.  |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
