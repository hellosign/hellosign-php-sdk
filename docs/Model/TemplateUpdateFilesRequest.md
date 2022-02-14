# # TemplateUpdateFilesRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `client_id` | ```string``` |  Client ID of the app you&#39;re using to create this template.  |  |
| `file` | ```\SplFileObject[]``` |  **file** or **file_url** is required, but not both.<br><br>Use `file[]` to indicate the uploaded file(s) to use for the template<br><br>Currently we only support use of either the `file[]` parameter or `file_url[]` parameter, not both.  |  |
| `file_url` | ```string[]``` |  **file_url** or **file** is required, but not both.<br><br>Use `file_url[]` to have HelloSign download the file(s) to use for the template.<br><br>Currently we only support use of either the `file[]` parameter or `file_url[]` parameter, not both.  |  |
| `message` | ```string``` |  The new default template email message.  |  |
| `subject` | ```string``` |  The new default template email subject.  |  |
| `test_mode` | ```bool``` |  Whether this is a test, the signature request created from this draft will not be legally binding if set to `true`. Defaults to `false`.  |  [default to false] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
