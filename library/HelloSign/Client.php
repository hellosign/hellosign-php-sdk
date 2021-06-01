<?php
/**
 * HelloSign PHP SDK (https://github.com/hellosign/hellosign-php-sdk/)
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

    const VERSION = '3.7.0';

    const API_URL = "https://api.hellosign.com/v3/";

    const ACCOUNT_PATH          = "account";
    const ACCOUNT_CREATE_PATH   = "account/create";
    const ACCOUNT_VALIDATE_PATH = "account/verify";

    const SIGNATURE_REQUEST_PATH      = "signature_request";
    const SIGNATURE_REQUEST_SEND_PATH = "signature_request/send";
    const SIGNATURE_REQUEST_LIST_PATH = "signature_request/list";

    const SIGNATURE_REQUEST_CANCEL_PATH            = "signature_request/cancel";
    const SIGNATURE_REQUEST_REMIND_PATH            = "signature_request/remind";
    const SIGNATURE_REQUEST_UPDATE_PATH            = "signature_request/update";
    const SIGNATURE_REQUEST_REMOVE_PATH            = "signature_request/remove";
    const SIGNATURE_REQUEST_FILES_PATH             = "signature_request/files";
    const SIGNATURE_REQUEST_EMBEDDED_PATH          = "signature_request/create_embedded";
    const SIGNATURE_REQUEST_EMBEDDED_TEMPLATE_PATH = "signature_request/create_embedded_with_template";
    const SIGNATURE_REQUEST_BULK_SEND_PATH         = "signature_request/bulk_send_with_template";
    const SIGNATURE_REQUEST_EMBEDDED_BULK_SEND_PATH = "signature_request/bulk_create_embedded_with_template";

    const TEMPLATE_PATH                   = "template";
    const TEMPLATE_LIST_PATH              = "template/list";
    const TEMPLATE_ADD_USER_PATH          = "template/add_user";
    const TEMPLATE_REMOVE_USER_PATH       = "template/remove_user";
    const TEMPLATE_SIGNATURE_REQUEST_PATH = "signature_request/send_with_template";
    const TEMPLATE_CREATE_EMBEDDED_DRAFT  = "template/create_embedded_draft";
    const TEMPLATE_DELETE_PATH            = "template/delete";
    const TEMPLATE_FILES_PATH             = "template/files";
    const TEMPLATE_UPDATE_FILES_PATH      = "template/update_files";

    const BULK_SEND_JOB_PATH              = "bulk_send_job";
    const BULK_SEND_JOB_LIST_PATH         = "bulk_send_job/list";

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
    const UNCLAIMED_DRAFT_EDIT_AND_RESEND_PATH = "unclaimed_draft/edit_and_resend";

    const APIAPP_PATH = "api_app";
    const APIAPP_LIST_PATH = "api_app/list";

    const OAUTH_TOKEN_URL = "https://app.hellosign.com/oauth/token";

    protected $oauth_token_url = self::OAUTH_TOKEN_URL;

    /**
     * Reference to the REST object
     *
     * @var REST $rest
     */
    protected $rest;

    /**
     * HTTP client configuration via the Guzzle library specification
     *
     * @var array $http_client_config
     */
    protected $http_client_config = array();

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
     * @param  array $http_client_config (optional) configuration for the http client
     */
    public function __construct($first, $last = null, $api_url = self::API_URL, $oauth_token_url = self::OAUTH_TOKEN_URL, $http_client_config = array())
    {
        $this->oauth_token_url = $oauth_token_url;
        $this->http_client_config = $http_client_config;
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
     * Send a new SignatureRequest with the submitted documents
     *
     * @param  SignatureRequest $request
     * @return SignatureRequest
     * @throws BaseException
     */
    public function sendSignatureRequest(SignatureRequest $request)
    {
        $params = $request->toParams();

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
     * Note: You cannot send a reminder within 1 hour of the last reminder that
     * was sent, manually or automatically.
     *
     * @param  string $request_id Signature Request ID
     * @param  string $email Email address of the signer
     * @param  string $name Name of signer to send reminder to (optional)
     * @return SignatureRequest
     * @throws BaseException
     */
    public function requestEmailReminder($request_id, $email, $name = null)
    {
        $response = $this->rest->post(
            static::SIGNATURE_REQUEST_REMIND_PATH . '/' . $request_id,
            array('email_address' => $email, 'name' => $name)
        );

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Updates the email address for a given signer on a SignatureRequest
     *
     * @param  string $request_id Signature Request ID to update
     * @param  string $signature_id The Signature ID for the recipient
     * @param  string $email The new email address for the recipient
     * @return SignatureRequest
     * @throws BaseException
     */
    public function updateSignatureRequest($request_id, $signature_id, $email)
    {
        $response = $this->rest->post(
            static::SIGNATURE_REQUEST_UPDATE_PATH . '/' . $request_id,
            array('signature_id' => $signature_id, 'email_address' => $email)
        );

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Removes your access to a completed SignatureRequest.
     * Note that this action is NOT reversible.
     *
     * @param  string $request_id Signature Request ID to remove access
     * @return boolean
     * @throws BaseException
     */
    public function removeSignatureRequestAccess($request_id)
    {
        $response = $this->rest->post(
            static::SIGNATURE_REQUEST_REMOVE_PATH . '/' . $request_id
        );

        $this->checkResponse($response, false);

        return true;
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
     * Retrieves the specified Template
     *
     * @param  string $id Template ID to retrieve
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
     * Retrieves a list of Templates that are accessible by this account
     *
     * @param  integer $page Specified page number to return. Defaults to 1. (optional)
     * @param  integer $page_size Number of objects to return per page between 1 and 100. Defaults to 20. (optional)
     * @param  string $account_id Account ID to return Templates for. Defaults to your account. (optional)
     * @return TemplateList
     * @throws BaseException
     */
    public function getTemplates($page = 1, $page_size = null, $account_id = null)
    {
        $response = $this->rest->get(static::TEMPLATE_LIST_PATH,
          array('account_id' => $account_id,
            'page' => $page,
            'page_size' => $page_size)
        );

        $this->checkResponse($response);

        $list = new TemplateList($response);

        if ($page > $list->getNumPages()) {
            throw new Error('page_not_found', 'Page not found');
        }

        return $list;
    }

    /**
     * Gives the specified Account access to the specified Template. The user can
     * be designated using their account ID or email address.
     *
     * @param  string $template_id Template ID to give the Account access to.
     * @param  string $id_or_email Account ID or email address to give access to the Template.
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
     * Removes the specified Account access to the specified Template. The user
     * can be designated using their account ID or email.
     *
     * @param  string $template_id Template ID to remove the Account access to.
     * @param  string $id_or_email Account ID or email address to remove access to the Template.
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
     * The first step in an EmbeddedTemplate workflow.
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
     * Deletes the specified Template from the Account.
     *
     * @param  string $template_id Template ID to delete
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
     * @param  string $template_id Template ID to retrieve files
     * @param  string $dest_path Where should the file be saved. Will retrieve link if empty. (optional)
     * @param  string $type Return the files as a single PDF or a zip of each document. Links will always be PDFs. (optional)
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
    * Creates a new Template using the overlay of specified Template
    *
    * @param string $template_id Template ID to update
    * @param Template $request Template Object settings to apply to the new Template
    * @return string
    */

    public function updateTemplateFiles($template_id, Template $request)
    {
      $params = $request->toUpdateParams();
      $response = $this->rest->post(
        static::TEMPLATE_UPDATE_FILES_PATH . '/' . $template_id,
        $params
      );

      return new Template($response);
    }

    /**
     * Creates a new Signature Request based on the Template provided
     *
     * @param  TemplateSignatureRequest $request
     * @return SignatureRequest
     * @throws BaseException
     */
    public function sendTemplateSignatureRequest(TemplateSignatureRequest $request)
    {
        $params = $request->toParams();

        $response = $this->rest->post(
            static::TEMPLATE_SIGNATURE_REQUEST_PATH,
            $params
        );

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Retrieves a SignatureRequest with the given ID
     *
     * @param  String $id Signature Request ID
     * @return SignatureRequest
     * @throws BaseException
     */
    public function getSignatureRequest($id)
    {
        $response = $this->rest->get(
            static::SIGNATURE_REQUEST_PATH . '/' . $id
        );

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Retrieves the current user's signature requests. The resulting object
     * represents a paged query result.
     *
     * @param int $page
     * @param int $page_size
     * @param null|string $query
     * @return SignatureRequestList
     * @throws BaseException
     * @throws Error
     */
    public function getSignatureRequests($page = 1, $page_size = 20, $query = null)
    {
        $params = array(
            'page' => $page,
            'page_size' => $page_size,
            'query' => $query,
        );

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
     * Creates a SignatureRequest that can be embedded within your website
     *
     * @param  EmbeddedSignatureRequest $request
     * @return SignatureRequest
     * @throws BaseException
     */
    public function createEmbeddedSignatureRequest(EmbeddedSignatureRequest $request)
    {
        $params = $request->toParams();

        // choose url
        $url = $request->isUsingTemplate()
            ? static::SIGNATURE_REQUEST_EMBEDDED_TEMPLATE_PATH
            : static::SIGNATURE_REQUEST_EMBEDDED_PATH;

        $response = $this->rest->post($url, $params);

        $this->checkResponse($response);

        return new SignatureRequest($response);
    }

    /**
     * Retrieves an embedded object containing a signature URL that can be opened in an iFrame.
     *
     * @param  string $id The signature_id of the SignatureRequest to embed
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
     * Retrieves an embedded object containing an edit URL that can be opened in an iFrame
     * to edit an EmbeddedTemplate.
     *
     * @param  string $id The ID of the EmbeddedTemplate to edit or create.
     * @param  Template $request Template object with settings for the Embedded Template
     * @return EmbeddedResponse
     * @throws BaseException
     */
    public function getEmbeddedEditUrl($id, Template $request = null)
    {
        if ($request !== null) {
          $params = $request->toParams();
          $response = $this->rest->post(
            static::EMBEDDED_EDIT_URL_PATH . '/' . $id,
            $params
          );
        } else {
          $response = $this->rest->get(
            static::EMBEDDED_EDIT_URL_PATH . '/' . $id
          );
        }


        $this->checkResponse($response);

        return new EmbeddedResponse($response);
    }

    /**
     * Creates an UnclaimedDraft using the provided request draft object
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
     * Creates an UnclaimedDraft using the provided request draft object
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
     * Creates a new SignatureRequest from another request that can be edited
     * prior to being sent to the recipients.
     *
     * @param  string $id The Signature Request ID to copy
     * @param  UnclaimedDraft $draft
     * @return UnclaimedDraft The newly created draft
     * @throws BaseException
     */
    public function unclaimedDraftEditAndResend($id, UnclaimedDraft $draft)
    {
        $response = $this->rest->post(
          static::UNCLAIMED_DRAFT_EDIT_AND_RESEND_PATH . '/' . $id,
          $draft->toEditParams()
        );

        $this->checkResponse($response);

        return $draft->fromResponse($response);
    }

    /**
     * Performs an OAuth request and returns the OAuthToken object for authorizing
     * an API App, and will automatically set the access token for
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
        $rest = new REST(
                array(
                'server' => $this->oauth_token_url,
                'debug_mode' => $this->debug_mode
            ),
            $this->http_client_config
        );

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
        $rest = new REST(
                array(
                'server' => $this->oauth_token_url,
                'debug_mode' => $this->debug_mode
            ),
            $this->http_client_config
        );

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
     * Returns the current user's HelloSign account information
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
     * Returns true if an Account exists with the provided email address. Note
     * this is limited to the visibility of the currently authenticated user.
     *
     * @param  string $email Email address to validate.
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
     * to generate an OAuth token automatically with the user Account response.
     *
     * @param  Account $account
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
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
     * Retrieves the Team for the current Account
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
     * Creates a new Team for the current Account
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
     * Updates the current Account's Team name
     *
     * @param  string $name New Team name
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
     * Deletes the current Account's Team
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
     * Adds the specified Account to the current Team
     *
     * @param  string $id_or_email Account ID or email address of the Account to invite
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
     * Removes the specified Account from the current Team
     *
     * @param  string $id_or_email Account ID or email address of the Account to remove
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
     * Removes all team members from current Team
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
     * Checks response and throws Exception if response is not proper
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
            } else {
                throw new Error(null, null, $status);
            }
        }
    }

    /**
     * Checks response and throws Exception if response is not proper
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
     * Creates REST object
     *
     * @param  mixed $first email address or apikey or OAuthToken
     * @param  string $last Null if using apikey or OAuthToken
     * @return REST
     * @ignore
     */
    protected function createREST($first, $last = null, $api_url = self::API_URL)
    {
        if ($first instanceof OAuthToken) {
            $rest = new REST(
                    array(
                    'server' => $api_url,
                    'debug_mode' => $this->debug_mode
                ),
                $this->http_client_config
            );
            $auth = $first->getTokenType() . ' ' . $first->getAccessToken();
            $rest->setHeader('Authorization', $auth);

            return $rest;
        }

        return new REST(
            array(
                'server' => $api_url,
                'user'   => $first,
                'pass'   => $last,
                'debug_mode' => $this->debug_mode
            ),
            $this->http_client_config
        );
    }

    /**
     * Creates a new API App
     *
     * @param  ApiApp $apiApp
     * @return ApiApp
     * @throws BaseException
     */
    public function createApiApp(ApiApp $apiApp)
    {
        $post = $apiApp->toCreateParams();

        $response = $this->rest->post(
            static::APIAPP_PATH,
            $post
        );

        $this->checkResponse($response);

        return $apiApp->fromResponse($response);
    }

    /**
     * Updates your API App's settings
     *
     * @param  ApiApp $apiApp
     * @return ApiApp
     * @throws BaseException
     */
    public function updateApiApp($client_id, ApiApp $app)
    {
        $response = $this->rest->post(
            static::APIAPP_PATH . '/' . $client_id,
            $app->toUpdateParams()
        );

        $this->checkResponse($response);

        return $app->fromResponse($response);
    }

    /**
     * Retrieves an API App with the given Client ID
     *
     * @param  String $id Client ID
     * @return ApiApp
     * @throws BaseException
     */
    public function getApiApp($id)
    {
        $params = array();
        $response = $this->rest->get(
            static::APIAPP_PATH . '/' . $id,
            $params
        );
        $this->checkResponse($response);
        return new ApiApp($response);
    }

    /**
     * Completely deletes the API app specified from the account.
     *
     * @param  string $client_id client ID
     * @return boolean
     * @throws BaseException
     */
    public function deleteApiApp($client_id)
    {

        $response = $this->rest->delete(
            static::APIAPP_PATH . '/' . $client_id
        );

        $this->checkResponse($response, false);

        return true;
    }

    /**
     * Retrieves a list of API Apps for account
     *
     * @param  integer $page
     * @param  integer $page_size
     * @return ApiAppList
     * @throws BaseException
     */
    public function getApiApps($page = 1, $page_size = 20)
    {
        $response = $this->rest->get(static::APIAPP_LIST_PATH, array('page' => $page, 'page_size' => $page_size));

        $this->checkResponse($response);

        $list = new ApiAppList($response);

        if ($page > $list->getNumPages()) {
            throw new Error('page_not_found', 'Page not found');
        }

        return $list;
    }

    /**
     * Creates a new Bulk Send Job using the specified Template
     *
     * @param  BulkSendJob $request
     * @return BulkSendJob
     * @throws BaseException
     */
    public function sendBulkSendJobWithTemplate(BulkSendJob $request)
    {
        $params = $request->toParams();

        $response = $this->rest->post(
            static::SIGNATURE_REQUEST_BULK_SEND_PATH,
            $params
        );

        $this->checkResponse($response);

        return new BulkSendJob($response);
    }

    /**
     * Creates a new embedded Bulk Send Job using the specified Template
     *
     * @param  EmbeddedBulkSendJob $request
     * @return BulkSendJob
     * @throws BaseException
     */
    public function sendEmbeddedBulkSendJobWithTemplate(EmbeddedBulkSendJob $request)
    {
        $params = $request->toParams();

        $response = $this->rest->post(
            static::SIGNATURE_REQUEST_EMBEDDED_BULK_SEND_PATH,
            $params
        );

        $this->checkResponse($response);

        return new BulkSendJob($response);
    }

    /**
     * Retrieves a Bulk Send Job with the given Bulk Send Job ID
     *
     * @param  String $id Bulk Send Job ID
     * @return BulkSendJob
     * @throws BaseException
     */
    public function getBulkSendJob($id)
    {
        $params = array();

        $response = $this->rest->get(
            static::BULK_SEND_JOB_PATH . '/' . $id,
            $params
        );

        $this->checkResponse($response);

        return new BulkSendJob($response);
    }

    /**
     * Retrieves a list of Bulk Send Jobs for account
     *
     * @param  integer $page
     * @param  integer $page_size
     * @return BulkSendJobList
     * @throws BaseException
     */
    public function getBulkSendJobs($page = 1, $page_size = 20)
    {
        $response = $this->rest->get(static::BULK_SEND_JOB_LIST_PATH, array('page' => $page, 'page_size' => $page_size));

        $this->checkResponse($response);

        $list = new BulkSendJobList($response);

        if ($page > $list->getNumPages()) {
            throw new Error('page_not_found', 'Page not found');
        }

        return $list;
    }
}
