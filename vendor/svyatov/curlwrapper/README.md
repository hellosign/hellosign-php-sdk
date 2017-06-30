CurlWrapper
===========

Flexible wrapper class for PHP cURL extension

See [php.net/curl](http://php.net/curl) for more information about the libcurl extension for PHP.

It's a fairly simple library, so if you want something more powerful take a look at [Guzzle](https://github.com/guzzle/guzzle).


Install
-------

### via Composer (recommended)

`php composer.phar require svyatov/curlwrapper '~1.3'`

### via download

Just grab the [latest release](https://github.com/svyatov/CurlWrapper/releases).


Usage
-----

### Initialization

```php
try {
    $curl = new CurlWrapper();
} catch (CurlWrapperException $e) {
    echo $e->getMessage();
}
```

### Performing request

The CurlWrapper object supports 5 types of requests: HEAD, GET, POST, PUT, and DELETE. You must specify an url to request and optionally specify an associative array or query string of variables to send along with it.

```php
$response = $curl->head($url, $params);
$response = $curl->get($url, $params);
$response = $curl->post($url, $params);
$response = $curl->put($url, $params);
$response = $curl->delete($url, $params);
```

To use a custom request methods, you can call the `request` method:

```php
$response = $curl->request($url, 'ANY_CUSTOM_REQUEST_TYPE', $params);
```


Examples:

```php
$response = $curl->get('google.com?q=test');

$response = $curl->get('google.com?q=test', array('some_variable' => 'some_value'));
// CurlWrapper will append '&some_variable=some_value' to the url

$response = $curl->post('test.com/posts', array('title' => 'Test', 'body' => 'This is a test'));
```

All requests return response body as is or throw a CurlWrapperException if an error occurred.

### Performing POST/PUT request with raw payload

Some times you need to send not encoded POST params, but a raw JSON or other raw data format.

```php
$response = $curl->rawPost($url, $jsonData);
$response = $curl->rawPut($url, 'raw random data');
```

Note that data is sending as as, without any URL-encoding manipulation. Keep that in mind.

You might also need to change the content type header for those types of request:

```php
$curl->addHeader('Content-Type', 'text/plain');
// or
$curl->addHeader('Content-Type', 'application/json');
// and then
$response = $curl->rawPost($url, $jsonData);
```

It depends on API server-side you are working with.


### Getting additional information about request sent

```php
$info = $curl->getTransferInfo();
```

This will give you associative array with following keys:

* `url` - Last effective URL
* `content_type` - Content-Type: of downloaded object, NULL indicates server did not send valid Content-Type: header
* `http_code` - Last received HTTP code
* `header_size` - Total size of all headers received
* `request_size` - Total size of issued requests, currently only for HTTP requests
* `filetime` - Remote time of the retrieved document, if -1 is returned the time of the document is unknown
* `ssl_verify_result` - Result of SSL certification verification requested by setting CURLOPT_SSL_VERIFYPEER
* `redirect_count` - Number of redirects it went through if CURLOPT_FOLLOWLOCATION was set
* `total_time` - Total transaction time in seconds for last transfer
* `namelookup_time` - Time in seconds until name resolving was complete
* `connect_time` - Time in seconds it took to establish the connection
* `pretransfer_time` - Time in seconds from start until just before file transfer begins
* `size_upload` - Total number of bytes uploaded
* `size_download` - Total number of bytes downloaded
* `speed_download` - Average download speed
* `speed_upload` - Average upload speed
* `download_content_length` - content-length of download, read from Content-Length: field
* `upload_content_length` - Specified size of upload
* `starttransfer_time` - Time in seconds until the first byte is about to be transferred
* `redirect_time` - Time in seconds of all redirection steps before final transaction was started
* `certinfo` - There is official description for this field yet
* `request_header` - The request string sent. For this to work, add the CURLINFO_HEADER_OUT option

You can also easily fetch any single piece of this array:

```php
$httpCode = $curl->getTransferInfo('http_code');
```


### Cookie sessions

To maintain a session across requests and cookies support you must set file's name where cookies to store:

```php
$curl->setCookieFile('some_file_name.txt');
```

This file must be writeble or the CurlWrapperException will be thrown.


### Basic configuration options

You can easily set the referer, user-agent, timeout and whether or not follow redirects:

```php
$curl->setReferer('http://google.com');
$curl->setUserAgent('some user agent string');
$curl->setTimeout(15); // seconds
$curl->setFollowRedirects(true); // to follow redirects
```

### HTTP Basic Authentication

You can set a username and password for use in HTTP basic auth:
```php
$curl->setAuthType();
$curl->setAuthCredentials('username', 'password');
```

### Setting custom headers

You can set custom headers to send with the request:

```php
$curl->addHeader('Host', '98.52.78.243');
$curl->addHeader('Some-Custom-Header', 'Some Custom Value');
```

Or use a single array:

```php
$curl->addHeader(array('Host'=>'98.52.78.243', 'Some-Custom-Header'=>'Some Custom Value'));
```


### Setting custom cURL options

You can set/override any cURL option (see the [curl_setopt documentation](http://www.php.net/manual/en/function.curl-setopt.php) for a list of them):

```php
$curl->addOption(CURLOPT_AUTOREFERER, true);
```


Changelog
---------

* **v1.3.0**

    `new` added *setAuthType()* and *setAuthCredentials()* methods for HTTP basic authentication

* **v1.2.0**

    `new` added *rawPost()* and *rawPut()* methods for POST/PUT requests with raw payload

    `new` added *setFollowRedirects()* method for quick access to cURL *CURLOPT_FOLLOWLOCATION* option

Contributing
------------

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Added some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request