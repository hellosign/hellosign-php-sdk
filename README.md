## HelloSign PHP SDK
[![Build Status](https://travis-ci.org/hellosign/hellosign-php-sdk.svg?branch=v3)](https://travis-ci.org/hellosign/hellosign-php-sdk)

This is the official PHP SDK for HelloSign's API.  [View API Documentation and Examples.](https://app.hellosign.com/api/documentation)

## Installation

### Requirements

The latest version of the SDK requires PHP version 7.1 or higher.

You can import this SDK into your library two ways, either through including the base HelloSign.php file into your
project or using [Composer](https://getcomposer.org/doc/00-intro.md).

To use Composer:

- First, install Composer if you don't have it already

    ```shell
    curl -sS https://getcomposer.org/installer | php
    ```

- Create a `composer.json` file and add the following:

    ```json
    {
        "require": {
            "hellosign/hellosign-php-sdk": "^3.0"
        }
    }
    ```

- Install `hellosign-php-sdk` package via Composer

    ```shell
    php composer.phar install
    ```

- Include the library in your script

    ```php
    require_once 'vendor/autoload.php';
    ```
- See below for how to configure your Client class.

## Configuration

All HelloSign API requests can be made using the `HelloSign\Client` class. This class must be initialized with your authentication details such as an API key (preferred), email/password combo, or OAuth credentials.

### API key Config
```php
$client = new HelloSign\Client($apikey);
```

### Email/Password Config

```php
$client = new HelloSign\Client($email_address, $password);
```

### Oauth Config

```php
$client = new HelloSign\Client($oauth_token); //instance of HelloSign\OAuthToken
```

Your app users are almost ready to start signing!
See below for the most common use cases for this wrapper.

## Usage

You can test your authentication by calling

```php
$account = $client->getAccount();
```

### Retrieving fields returned from the API

Using magic methods

```php
$signature_request->title;
```

Or if you want to get all attributes in an array

```php
$signature_request->toArray();
```

### Creating a Signature Request

```php
$request = new HelloSign\SignatureRequest;
$request->enableTestMode();
$request->setTitle('NDA with Acme Co.');
$request->setSubject('The NDA we talked about');
$request->setMessage('Please sign this NDA and let\'s discuss.');
$request->addSigner('jack@example.com', 'Jack');
$request->addSigner('jill@example.com', 'Jill');
$request->addCC('lawyer@example.com');
$request->addFile('nda.pdf'); //Adding file from local

$response = $client->sendSignatureRequest($request);
```

To specify a URL to a remote file instead use:

```php
$request->addFileURL('PUBLIC_URL_TO_YOUR_FILE');
```

If you are using Text Tags in your document, you can enable and configure them through the respective methods:

```php
$request->setUseTextTags(true);
$request->setHideTextTags(true);
```

Or if you want to set Form Fields per Document:

```php
$request->setFormFieldsPerDocument(
            array(
                array( //document 1
                    array( //field 1
                        "api_id"=> $random_prefix . "_1",
                        "name"=> "",
                        "type"=> "text",
                        "x"=> 112,
                        "y"=> 328,
                        "width"=> 100,
                        "height"=> 16,
                        "required"=> true,
                        "signer"=> 0
                    ),
                    array( //field 2
                        "api_id"=> $random_prefix . "_2",
                        "name"=> "",
                        "type"=> "signature",
                        "x"=> 530,
                        "y"=> 415,
                        "width"=> 150,
                        "height"=> 30,
                        "required"=> true,
                        "signer"=> 1
                    ),
                ),
            )
        );
```

### Retrieving a User's Templates

The HelloSign API provides paged lists for user templates and signature requests. These lists are represented as objects that can be iterated upon.

```php
$templates = $client->getTemplates($page_number);
foreach ($templates as $template) {
    echo $template->getTitle() . "\n";
}
```

### Creating a Signature Request from a Template

```php
$request = new HelloSign\TemplateSignatureRequest;
$request->enableTestMode();
$request->setTemplateId($template->getId());
$request->setSubject('Purchase Order');
$request->setMessage('Glad we could come to an agreement.');
$request->setSigner('Client', 'george@example.com', 'George');
$request->setCC('Accounting', 'accounting@example.com');
$request->setCustomFieldValue('Cost', '$20,000');

$response = $client->sendTemplateSignatureRequest($request);
```

### Checking the Status of a Signature Request

```php
$response = $client->getSignatureRequest($signature_request_id);
if ($response->isComplete()) {
    echo 'All signers have signed this request.';
} else {
    foreach ($response->getSignatures() as $signature) {
        echo $signature->getStatusCode() . "\n";
    }
}
```

### Creating an Embedded Signature Request to use for Embedded Signing
Refer to the (Embedded Signing Walkthrough)[https://app.hellosign.com/api/embeddedSigningWalkthrough] for more details.

```php
// Create the SignatureRequest or TemplateSignatureRequest object
$request = ...

// Turn it into an embedded request
$embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);

// Send it to HelloSign
$response = $client->createEmbeddedSignatureRequest($embedded_request);

// Grab the signature ID for the signature page that will be embedded in the
// page (for the demo, we'll just use the first one)
$signatures   = $response->getSignatures();
$signature_id = $signatures[0]->getId();

// Retrieve the URL to sign the document
$response = $client->getEmbeddedSignUrl($signature_id);

// Store it to use with the embedded.js HelloSign.open() call
$sign_url = $response->getSignUrl();
```


### Creating an Embedded Template draft

```php
$template = new HelloSign\Template();
$template->enableTestMode();
$template->setClientId($client_id);
$template->addFile('nda.pdf');
$template->setTitle('Test Title');
$template->setSubject('Test Subject');
$template->setMessage('Test Message');
$template->addSignerRole('Test Role');
$template->addMetadata('custom_id', '1234');

$response = $client->createEmbeddedDraft($template);
```

### Creating an Unclaimed Draft to use for Embedded Requesting

```php

$draft = new HelloSign\UnclaimedDraft($request, $client_id);
// optionally change it to a self-signing draft with $draft->setType("send_document");
$response = $client->createUnclaimedDraft($draft);

// Store it to use with the embedded.js HelloSign.open() call
$sign_url = $response->getClaimUrl();
```


### Enabling OAuth

```php
// If the account does not exist
if !($client->isAccountValid($email)) {
    // Create new account
    $account = $client->createAccount(
        new HelloSign\Account($email),
        $client_id,
        $client_secret
    );

    // Get OAuth token
    $token = $account->getOAuthData();
} else {
    // Create the OAuthTokenRequest object
    $oauth_request = new HelloSign\OAuthTokenRequest(array(
        'code'          => $code,
        'state'         => $state,
        'client_id'     => $client_id,
        'client_secret' => $client_secret
    ));

    // Request OAuth token for the first time
    $token = $client->requestOAuthToken($oauth_request);
}

// Export token to array, store it to use later
$hellosign_oauth = $token->toArray();

// Populate token from array
$token = new HelloSign\OAuthToken($hellosign_oauth);

// Refresh token if it expired
$client->refreshOAuthToken($token);

// Provide the user's OAuth access token to the client
$client = new HelloSign\Client($token);
```

## Displaying warnings

Any warnings returned from the API can be accessed via the returned object / list via the getWarnings method:

````php
  $response = $this->client->getSignatureRequests();
  print_r($response->getWarnings());
````

## Testing

This project contains PHPUnit tests that check the SDK code and can also be referenced for examples. Most are functional and integrated tests that walk through real user scenarios.

In order to pass the unit tests, you will need:

1. The API Key for a confirmed HelloSign account
2. The client ID and secret key from a confirmed HelloSign API App
3. A HelloSign subscription (to create a team)
4. A HelloSign API subscription (to access paid API endpoints)
5. A template with 1 signer role named 'Signer'
6. A Team with 1 additional team member

*** WARNING: these tests will add and remove users from your team. Use with caution.

### To run the tests

- Copy file `phpunit.xml.dist` to `phpunit.xml`
- Edit the new file and enter your values for `API_KEY`, `CLIENT_ID`, `CLIENT_SECRET`, `CALLBACK_URL`, `API_URL`, AND `OAUTH_TOKEN_URL`
- Run `./vendor/bin/phpunit`

## License

```
The MIT License (MIT)

Copyright (C) 2014 hellosign.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```
