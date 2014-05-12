##HelloSign PHP SDK

This is the official PHP SDK for HelloSign's API.  [View api documentation and examples.](https://www.hellosign.com/api/gettingStarted)

##Installation

### Requirements

1. PHP >= 5.3
2. PHP curl extensions.

You don't need to clone the repo directly to use this SDK, the entire library and its dependencies can be installed through Composer ( [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md) ).

- First, install Composer if you don't have it already

    ```shell
    curl -sS https://getcomposer.org/installer | php
    ```

- Create `composer.json` and add the following

    ```json
    {
        "require": {
            "hellosign/hellosign-php-sdk": "3.*@dev"
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

##Configuration

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


##Usage

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
$request->addFile('nda.pdf');

$response = $client->sendSignatureRequest($request);
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

### Creating an Unclaimed Draft to use for Embedded Requesting

```php

$draft = new HelloSign\UnclaimedDraft($request, $client_id);
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
        new HelloSign\Account($email, $password),
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

## Testing

This project contains PHPUnit tests that check the SDK code and can also be referenced for examples. Most are functional and integrated tests that walk through real user scenarios. In some cases, this means you must have an active network connection with access to HelloSign to execute all tests. Also, your testing account will need at least 1 template for the template tests to pass.

*** WARNING: these tests will add and remove users from your team. Use with caution.

### To run the tests

- Copy file `phpunit.xml.sample` to `phpunit.xml`
- Edit the new file, uncomment and enter your `API_KEY`, `CLIENT_ID`, `CLIENT_SECRET` and `CALLBACK_URL`
- Make sure your account has at least 1 template
- Run `./vendor/bin/phpunit`
