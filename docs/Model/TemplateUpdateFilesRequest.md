# # TemplateUpdateFilesRequest



## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
| `client_id` | ```string``` |  Client id of the app you&#39;re using to update this template.  |  |
| `file` | ```\SplFileObject[]``` |  Use `file[]` to indicate the uploaded file(s) to use for the template.<br><br>This endpoint requires either **file** or **file_url[]**, but not both.  |  |
| `file_url` | ```string[]``` |  Use `file_url[]` to have Dropbox Sign download the file(s) to use for the template.<br><br>This endpoint requires either **file** or **file_url[]**, but not both.  |  |
| `message` | ```string``` |  The new default template email message.  |  |
| `subject` | ```string``` |  The new default template email subject.  |  |
| `test_mode` | ```bool``` |  Whether this is a test, the signature request created from this draft will not be legally binding if set to `true`. Defaults to `false`.  |  [default to false] |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
