<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

/**
 * The MIT License (MIT)
 *
 * Copyright (C) 2014 hellosign.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace HelloSign;

include_once __DIR__ . '/../lib/REST.php';

use Comvi\REST;

/**
 * All HelloSign API requests can be made using HelloSign\Client class. This
 * class must be initialized with your authentication details, such as an API
 * key (preferred) or website credentials.
 */
class Client
{

    const VERSION = '3.5.0';

    const API_URL = "https://api.hellosign.com/v3/";

    const ACCOUNT_PATH          = "account";
    const ACCOUNT_CREATE_PATH   = "account/create";
    const ACCOUNT_VALIDATE_PATH = "account/verify";

    const SIGNATURE_REQUEST_PATH      = "signature_request";
    const SIGNATURE_REQUEST_SEND_PATH = "signature_request/send";
    const SIGNATURE_REQUEST_LIST_PATH = "signature_request/list";

    const SIGNATURE_REQUEST_CANCEL_PATH            = "signature_request/cancel";
    const SIGNATURE_REQUEST_REMIND_PATH            = "signature_request/remind";
    const SIGNATURE_REQUEST_FILES_PATH             = "signature_request/files";
    const SIGNATURE_REQUEST_EMBEDDED_PATH          = "signature_request/create_embedded";
    const SIGNATURE_REQUEST_EMBEDDED_TEMPLATE_PATH = "signature_request/create_embedded_with_template";

    const TEMPLATE_PATH                   = "template";
    const TEMPLATE_LIST_PATH              = "template/list";
    const TEMPLATE_ADD_USER_PATH          = "template/add_user";
    const TEMPLATE_REMOVE_USER_PATH       = "template/remove_user";
    const TEMPLATE_SIGNATURE_REQUEST_PATH = "signature_request/send_with_template";
    const TEMPLATE_CREATE_EMBEDDED_DRAFT  = "template/create_embedded_draft";
    const TEMPLATE_DELETE_PATH            = "template/delete";
    const TEMPLATE_FILES_PATH             = "template/files";

    const TEAM_PATH               = "team";
    const TEAM_CREATE_PATH        = "team/create";
    const TEAM_DESTROY_PATH       = "team/destroy";
    const TEAM_ADD_MEMBER_PATH    = "team/add_member";
    const TEAM_REMOVE_MEMBER_PATH = "team/remove_member";

    const EMBEDDED_SIGN_URL_PATH = "embedded/sign_url";
    const EMBEDDED_EDIT_URL_PATH = "embedded/edit_url";

    const UNCLAIMED_DRAFT_CREATE_PATH = "unclaimed_draft/create";
    const UNCLAIMED_DRAFT_CREATE_EMBEDDED_PATH = "unclaimed_draft/create_embedded";
    const UNCLAIMED_DRAFT_CREATE_EMBEDDED_WITH_TEMPLATE_PATH = "unclaimed_draft/create_embedded_with_template";

    const OAUTH_TOKEN_URL = "https://www.hellosign.com/oauth/token";

    protected $oauth_token_url = self::OAUTH_TOKEN_URL;

    /**
     * Reference to the REST object
     *
     * @var REST $rest
     */
    protected $rest;

    /**
     * Enable debug mode or not
     *
     * @var boolean
     */
    protected $debug_mode = false;

    /**
     * Constructor
     *
     * @param  mixed $first email address or apikey or OAuthToken
     * @param  string $last Null if using apikey or OAuthToken
     * @param  string $api_url (optional) alternative api base url
     */
    public function __construct($first, $last = null, $api_url = self::API_URL, $oauth_token_url = self::OAUTH_TOKEN_URL)
    {
        $this->oauth_token_url = $oauth_token_url;
        $this->rest = $this->createREST($first, $last, $api_url);
        $this->rest->setHeader('User-Agent', 'hellosign-php-sdk/' . self::VERSION);
    }

    /**
     * @return Client
     * @ignore
     */
    public function enableDebugMode()
    {
        $this->debug_mode = true;
        $this->rest->enableDebugMode();

        return $this;
    }

    /**
     *
     * Should only be used for unit tests that may be hitting a local endpoint
     */
    public function disableCertificateCheck($rest = null) {
        if (!$rest) {
            $rest = $this->rest;
        }
        $rest->disableCertificateCheck();
    }

    /**
     * Send a new SignatureRequest with the submitted documents
     *
     * @param  SignatureRequest $request
     * @param  Integer $ux_version
     * @return SignatureRequest
     * @throws BaseException
     */
    public function sendSignatureRequest(SignatureRequest $request, $ux_version = null)
    {
        $params = $request->toParams();
        if ($ux_version !== null) {
            $params['ux_version'] = $ux_version;
        }

        $response = $this->rest->post(
            static::SIGNATURE_REQUEST_SEND_PATH,
            $params
        );

        $this->checkResponse($response);

        return $request->fromResponse($response);
    }

    /**
     * Cancels an existing signature request
     *
     * If it has been completed, it will delete the signature request from
     * your account.
     *
     * @param  string $id
     * @return boolean
     * @throws BaseException
     */
    public function cancelSignatureRequest($id)
    {
        $response = $this->rest->post(
            static::SIGNATURE_REQUEST_CANCEL_PATH . '/' . $id
        );

        $this->checkResponse($response, false);

        return true;
    }

    /**
     * Instructs HelloSign to email the given address with a reminder to sign
     * the SignatureRequest referenced by the given request ID.
     *
     * Note: You cannot send a reminder within 1 hours of the last reminder that
     * was sent, manually or automatically.
     *
     * @param  string $request_id Signature Request ID
     * @param  string $email
     * @return SignatureRequest
     * @throws BaseException
     */
    public function requestEmailReminder($request_id, $email)
    {
        $response = $this->rest->post(
            static::SIGNATURE_REQUEST_REMIND_PATH . '/' . $request_id,
            array('email_address' => $email)
        );

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Retrieves a link or copy of the files associated with a signature request
     *
     * @param  string $request_id
     * @param  string $dest_path (optional) where should the file be saved. Will retrieve link if empty.
     * @param  string $type (optional) get the files as a single pdf or a zip of many. Links will always be pdfs.
     * @return string
     * @throws BaseException
     */
    public function getFiles($request_id, $dest_path = null, $type = null)
    {
        if ($dest_path) { // file stream
            $response = $this->rest->get(
                static::SIGNATURE_REQUEST_FILES_PATH . '/' . $request_id,
                $type ? array('file_type' => $type) : null
            );
            $this->checkResponse($response, false);
            file_put_contents($dest_path, $response);
        } else { // link
            $response = $this->rest->get(
                static::SIGNATURE_REQUEST_FILES_PATH . '/' . $request_id,
                array('get_url' => true)
            );

            return new FileResponse($response);
        }

        return $response;
    }

    /**
     * Retrieves the template by template id
     *
     * @param  string $id
     * @return stdClass
     * @throws BaseException
     */
    public function getTemplate($id)
    {
        $response = $this->rest->get(
            static::TEMPLATE_PATH . '/' . $id
        );

        $this->checkResponse($response);

        return new Template($response);
    }

    /**
     * Retrieves the templates for the current user account
     *
     * @param  integer $page
     * @return TemplateList
     * @throws BaseException
     */
    public function getTemplates($page = 1)
    {
        $response = $this->rest->get(static::TEMPLATE_LIST_PATH, array('page' => $page));

        $this->checkResponse($response);

        $list = new TemplateList($response);

        if ($page > $list->getNumPages()) {
            throw new Error('page_not_found', 'Page not found');
        }

        return $list;
    }

    /**
     * Gives the specified User access to the specified Template. The user can
     * be designated using their account ID or email address.
     *
     * @param  string $template_id template ID
     * @param  string $id_or_email account ID or email address
     * @return Template
     * @throws BaseException
     */
    public function addTemplateUser($template_id, $id_or_email)
    {
        $key = strpos($id_or_email, '@') ? 'email_address' : 'account_id';

        $response = $this->rest->post(
            static::TEMPLATE_ADD_USER_PATH . '/' . $template_id,
            array($key => $id_or_email)
        );

        $this->checkResponse($response);

        return new Template($response);
    }

    /**
     * Removes the specified User's access to the specified Template. The user
     * can be designated using their account ID or email.
     *
     * @param  string $template_id template ID
     * @param  string $id_or_email account ID or email address
     * @return Template
     * @throws BaseException
     */
    public function removeTemplateUser($template_id, $id_or_email)
    {
        $key = strpos($id_or_email, '@') ? 'email_address' : 'account_id';

        $response = $this->rest->post(
            static::TEMPLATE_REMOVE_USER_PATH . '/' . $template_id,
            array($key => $id_or_email)
        );

        $this->checkResponse($response);

        return new Template($response);
    }

    /**
     * The first step in an embedded template workflow.
     * Creates a draft template that can then be further set up in the template 'edit' stage.
     *
     * @param  Template $request
     * @return Template
     * @throws BaseException
     */
    public function createEmbeddedDraft(Template $request)
    {

        $response = $this->rest->post(
            static::TEMPLATE_CREATE_EMBEDDED_DRAFT,
            $request->toEmbeddedDraftParams()
        );

        $this->checkResponse($response);

        return new Template($response);
    }

    /**
     * Completely deletes the template specified from the account.
     *
     * @param  string $template_id template ID
     * @return boolean
     * @throws BaseException
     */
    public function deleteTemplate($template_id)
    {

        $response = $this->rest->post(
            static::TEMPLATE_DELETE_PATH . '/' . $template_id
        );

        $this->checkResponse($response, false);

        return true;
    }

    /**
     * Retrieves a link or copy of the files associated with a template
     *
     * @param  string $template_id
     * @param  string $dest_path (optional) where should the file be saved. Will retrieve link if empty.
     * @param  string $type (optional) get the files as a single pdf or a zip of many. Links will always be pdfs.
     * @return string
     * @throws BaseException
     */
    public function getTemplateFiles($template_id, $dest_path = null, $type = 'pdf')
    {
        if ($dest_path) { // file stream
            $response = $this->rest->get(
                static::TEMPLATE_FILES_PATH . '/' . $template_id,
                $type ? array('file_type' => $type) : null
            );
            $this->checkResponse($response, false);
            file_put_contents($dest_path, $response);
        } else { // link
            $response = $this->rest->get(
                static::TEMPLATE_FILES_PATH . '/' . $template_id,
                array('get_url' => true)
            );
        }

        return $response;
    }

    /**
     * Creates a new Signature Request based on the template provided
     *
     * @param  TemplateSignatureRequest $request
     * @param  Integer $ux_version
     * @return SignatureRequest
     * @throws BaseException
     */
    public function sendTemplateSignatureRequest(TemplateSignatureRequest $request, $ux_version = null)
    {
        $params = $request->toParams();
        if ($ux_version !== null) {
            $params['ux_version'] = $ux_version;
        }

        $response = $this->rest->post(
            static::TEMPLATE_SIGNATURE_REQUEST_PATH,
            $params
        );

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Retrieves a Signature Request with the given ID
     *
     * @param  String $id signature ID
     * @param  Integer $ux_version
     * @return SignatureRequest
     * @throws BaseException
     */
    public function getSignatureRequest($id, $ux_version = null)
    {
        $params = array();
        if ($ux_version !== null) {
            $params['ux_version'] = $ux_version;
        }

        $response = $this->rest->get(
            static::SIGNATURE_REQUEST_PATH . '/' . $id,
            $params
        );

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Retrieves the current user's signature requests. The resulting object
     * represents a paged query result.
     *
     * @param  Integer $page
     * @param  Integer $ux_version
     * @return SignatureRequestList
     * @throws BaseException
     */
    public function getSignatureRequests($page = 1, $ux_version = null)
    {
        $params = array(
            'page' => $page
        );
        if ($ux_version !== null) {
            $params['ux_version'] = $ux_version;
        }

        $response = $this->rest->get(
            static::SIGNATURE_REQUEST_LIST_PATH,
            $params
        );

        $this->checkResponse($response);

        $list = new SignatureRequestList($response);

        if ($page > $list->getNumPages()) {
            throw new Error('page_not_found', 'Page not found');
        }

        return $list;
    }

    /**
     * Creates a signature request that can be embedded within your website
     *
     * @param  EmbeddedSignatureRequest $request
     * @param  Integer $ux_version
     * @return SignatureRequest
     * @throws BaseException
     */
    public function createEmbeddedSignatureRequest(EmbeddedSignatureRequest $request, $ux_version = null)
    {
        $params = $request->toParams();
        if ($ux_version !== null) {
            $params['ux_version'] = $ux_version;
        }

        // choose url
        $url = $request->isUsingTemplate()
            ? static::SIGNATURE_REQUEST_EMBEDDED_TEMPLATE_PATH
            : static::SIGNATURE_REQUEST_EMBEDDED_PATH;

        $response = $this->rest->post($url, $params);

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Retrieves the necessary information to build an embedded signature
     * request
     *
     * @param  string $id ID of the signature request to embed
     * @return EmbeddedResponse
     * @throws BaseException
     */
    public function getEmbeddedSignUrl($id)
    {
        $response = $this->rest->get(
            static::EMBEDDED_SIGN_URL_PATH . '/' . $id
        );

        $this->checkResponse($response);

        return new EmbeddedResponse($response);
    }

    /**
     * Retrieves the necessary information to edit an embedded template
     *
     *
     * @param  string $id ID of the template to embed
     * @return EmbeddedResponse
     * @throws BaseException
     */
    public function getEmbeddedEditUrl($id)
    {
        $response = $this->rest->get(
            static::EMBEDDED_EDIT_URL_PATH . '/' . $id
        );

        $this->checkResponse($response);

        return new EmbeddedResponse($response);
    }

    /**
     * Creates an unclaimed draft using the provided request draft object
     *
     * @param  UnclaimedDraft $draft
     * @return UnclaimedDraft The created draft
     * @throws BaseException
     */
    public function createUnclaimedDraft(UnclaimedDraft $draft)
    {
        // choose url
        $url = $draft->getClientId()
            ? static::UNCLAIMED_DRAFT_CREATE_EMBEDDED_PATH
            : static::UNCLAIMED_DRAFT_CREATE_PATH;

        $response = $this->rest->post($url, $draft->toParams());

        $this->checkResponse($response);

        return $draft->fromResponse($response);
    }

    /**
     * Creates an unclaimed draft using the provided request draft object
     *
     * @param  EmbeddedSignatureRequest $request
     * @return UnclaimedDraft The created draft
     * @throws BaseException
     */
    public function createUnclaimedDraftEmbeddedWithTemplate(EmbeddedSignatureRequest $request)
    {
        $url = static::UNCLAIMED_DRAFT_CREATE_EMBEDDED_WITH_TEMPLATE_PATH;

        $response = $this->rest->post($url, $request->toParams());

        $this->checkResponse($response);

        $draft = new UnclaimedDraft();

        return $draft->fromResponse($response);
    }

    /**
     * Performs an OAuth request and returns the OAuthToken object for authorizing
     * an API application, and will automatically set the access token for
     * making authenticated requests with this client.
     *
     * @param OAuthTokenRequest $request
     * @param boolean $auto_set_request_token true if the token should be
     * immediately applied to this client
     * @return OAuthToken object containing OAuth token details
     * @throws BaseException
     */
    public function requestOAuthToken(OAuthTokenRequest $request, $auto_set_request_token = false)
    {
        $rest = new REST(array(
            'server' => $this->oauth_token_url,
            'debug_mode' => $this->debug_mode
        ));

        if ($this->oauth_token_url != self::OAUTH_TOKEN_URL) {
            $this->disableCertificateCheck($rest);
        }

        $response = $rest->post('', $request->toParams());

        $this->checkResponse($response);
        $this->checkOAuthTokenResponse($response);

        // populate object from response
        $token = new OAuthToken($response);

        if ($auto_set_request_token) {
            $this->rest = $this->createREST($token);
        }

        return $token;
    }

    /**
     * Refresh OAuth token, and will automatically set the access token for
     * making authenticated requests with this client.
     *
     * @param OAuthToken $token
     * @param boolean $auto_set_request_token true if the token should be
     * immediately applied to this client
     * @return OAuthToken object containing OAuth token details
     * @throws BaseException
     */
    public function refreshOAuthToken(OAuthToken $token, $auto_set_request_token = false)
    {
        $rest = new REST(array(
            'server' => $this->oauth_token_url,
            'debug_mode' => $this->debug_mode
        ));

        if ($this->oauth_token_url != self::OAUTH_TOKEN_URL) {
            $this->disableCertificateCheck($rest);
        }

        $response = $rest->post('', $token->toParams());

        $this->checkResponse($response);
        $this->checkOAuthTokenResponse($response);

        // populate object from response
        $token->fromObject($response);

        if ($auto_set_request_token) {
            $this->rest = $this->createREST($token);
        }

        return $token;
    }

    /**
     * Returns the current user's account information
     *
     * @return Account
     * @throws BaseException
     */
    public function getAccount()
    {
        $response = $this->rest->get(
            static::ACCOUNT_PATH
        );

        $this->checkResponse($response);

        return new Account($response);
    }

    /**
     * Returns true if an account exists with the provided email address. Note
     * this is limited to the visibility of the currently authenticated user.
     *
     * @param  string $email
     * @return boolean
     * @throws BaseException
     */
    public function isAccountValid($email)
    {
        $response = $this->rest->post(
            static::ACCOUNT_VALIDATE_PATH,
            array(
                'email_address' => $email
            )
        );

        $this->checkResponse($response);

        return property_exists($response, 'account');
    }

    /**
     * Creates a new HelloSign account
     *
     * If client_id & client_secret null: The user will still need to validate
     * their email address to complete the creation process.
     *
     * Else: Creates a new HelloSign account and provides OAuth app credentials
     * to automatically generate an OAuth token with the user Account response.
     *
     * @param  Account $account
     * @param  string $client_id
     * @param  string $client_secret
     * @return Account
     * @throws BaseException
     */
    public function createAccount(Account $account, $client_id = null, $client_secret = null)
    {
        $post = $account->toCreateParams();

        if ($client_id) {
            $post += array(
                'client_id' => $client_id,
                'client_secret' => $client_secret
            );
        }

        $response = $this->rest->post(
            static::ACCOUNT_CREATE_PATH,
            $post
        );

        $this->checkResponse($response);

        return $account->fromResponse($response);
    }

    /**
     * Updates your Account's settings
     *
     * @param  Account $account
     * @return Account
     * @throws BaseException
     */
    public function updateAccount(Account $account)
    {
        $response = $this->rest->post(
            static::ACCOUNT_PATH,
            $account->toUpdateParams()
        );

        $this->checkResponse($response);

        return $account->fromResponse($response);
    }

    /**
     * Retrieves the Team for the current user account
     *
     * @return Team
     * @throws BaseException
     */
    public function getTeam()
    {
        $response = $this->rest->get(
            static::TEAM_PATH
        );

        $this->checkResponse($response);

        return new Team($response);
    }

    /**
     * Creates a new team for the current user
     *
     * @param  Team $team
     * @return Team
     * @throws BaseException
     */
    public function createTeam(Team $team)
    {
        $response = $this->rest->post(
            static::TEAM_CREATE_PATH,
            $team->toCreateParams()
        );

        $this->checkResponse($response);

        return $team->fromResponse($response);
    }

    /**
     * Updates the current user's team name
     *
     * @param  string $name Team name
     * @return Team
     * @throws BaseException
     */
    public function updateTeamName($name)
    {
        $response = $this->rest->post(
            static::TEAM_PATH,
            array(
                'name' => $name
            )
        );

        $this->checkResponse($response);

        return new Team($response);
    }

    /**
     * Destroys the current user's team
     *
     * @return boolean
     * @throws BaseException
     */
    public function destroyTeam()
    {
        $response = $this->rest->post(
            static::TEAM_DESTROY_PATH
        );

        $this->checkResponse($response, false);

        return true;
    }

    /**
     * Adds the user to the current user's team
     *
     * @param  string $id_or_email account ID or email address
     * @return Team
     * @throws BaseException
     */
    public function inviteTeamMember($id_or_email)
    {
        $key = strpos($id_or_email, '@') ? 'email_address' : 'account_id';

        $response = $this->rest->post(
            static::TEAM_ADD_MEMBER_PATH,
            array($key => $id_or_email)
        );

        $this->checkResponse($response);

        return new Team($response);
    }

    /**
     * Removes the team member indicated by the user account ID or email address
     *
     * @param  string $id_or_email account ID or email address
     * @return Team
     * @throws BaseException
     */
    public function removeTeamMember($id_or_email)
    {
        $key = strpos($id_or_email, '@') ? 'email_address' : 'account_id';

        $response = $this->rest->post(
            static::TEAM_REMOVE_MEMBER_PATH,
            array($key => $id_or_email)
        );

        $this->checkResponse($response);

        return new Team($response);
    }

    /**
     * Removes all current user's team members
     *
     * @return Team
     * @throws BaseException
     */
    public function removeAllTeamMembers()
    {
        $team = $this->getTeam();
        $last_team = $team;

        foreach ($team->getAccounts() as $account) {
            if (!$account->isTeamAdmin()) {
                $last_team = $this->removeTeamMember($account->getId());
            }
        }

        return $last_team;
    }

    /**
     * check response and throw Exception if response is not proper
     *
     * @param  mixed $response
     * @param  boolean $strict
     * @throws BaseException
     * @ignore
     */
    protected function checkResponse($response, $strict = true)
    {
        $status = $this->rest->getStatus();
        if ($response === false) {
            throw new Error('unknown', 'Unknown error', $status);
        } elseif ($strict && is_string($response)) {
            throw new Error('invalid_format', 'Response should be returned in JSON format', $status);
        } elseif ($status >= 400) {
            if (property_exists($response, 'error')) {
                throw new Error($response->error->error_name, $response->error->error_msg, $status);
            } elseif (property_exists($response, 'warnings')) {
                // Only throw first warning
                throw new Warning($response->warnings[0]->warning_name, $response->warnings[0]->warning_msg, $status);
            } else {
                throw new Error(null, null, $status);
            }
        }
    }

    /**
     * check response and throw Exception if response is not proper
     *
     * @param  stdClass $response
     * @throws Error
     * @ignore
     */
    protected function checkOAuthTokenResponse($response)
    {
        if (property_exists($response, 'error') && property_exists($response, 'error_description')) {
            throw new Error($response->error, $response->error_description);
        }
    }

    /**
     * Create REST object
     *
     * @param  mixed $first email address or apikey or OAuthToken
     * @param  string $last Null if using apikey or OAuthToken
     * @return REST
     * @ignore
     */
    protected function createREST($first, $last = null, $api_url = self::API_URL)
    {
        if ($first instanceof OAuthToken) {
            $rest = new REST(array(
                'server' => $api_url,
                'debug_mode' => $this->debug_mode
            ));
            $auth = $first->getTokenType() . ' ' . $first->getAccessToken();
            $rest->setHeader('Authorization', $auth);

            return $rest;
        }

        return new REST(array(
            'server' => $api_url,
            'user'   => $first,
            'pass'   => $last,
            'debug_mode' => $this->debug_mode
        ));
    }
}
