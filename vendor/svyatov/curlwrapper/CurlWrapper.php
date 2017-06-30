<?php
/**
 * CurlWrapper - Flexible wrapper class for PHP cURL extension
 *
 * @author Leonid Svyatov <leonid@svyatov.ru>
 * @copyright 2010-2011, 2014 Leonid Svyatov
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @version 1.3.0
 * @link http://github.com/svyatov/CurlWrapper
 */
class CurlWrapper
{
    /**
     * @var resource cURL handle
     */
    protected $ch = null;
    /**
     * @var string Filename of a writable file for cookies storage
     */
    protected $cookieFile = '';
    /**
     * @var array Cookies to send
     */
    protected $cookies = array();
    /**
     * @var array Headers to send
     */
    protected $headers = array();
    /**
     * @var array cURL options
     */
    protected $options = array();
    /**
     * @var array Predefined user agents. The 'chrome' value is used by default
     */
    protected static $predefinedUserAgents = array(
        // IE 11
        'ie'       => 'Mozilla/5.0 (compatible; MSIE 11.0; Windows NT 6.1; WOW64; Trident/6.0)',
        // Firefox 29
        'firefox'  => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
        // Opera 20
        'opera'    => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.46 Safari/537.36 OPR/20.0.1387.24 (Edition Next)',
        // Chrome 32
        'chrome'   => 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36',
        // Google Bot
        'bot'      => 'Googlebot/2.1 (+http://www.google.com/bot.html)',
    );
    /**
     * @var array GET/POST params to send
     */
    protected $requestParams = array();
    /**
     * @var string cURL response data
     */
    protected $response = '';
    /**
     * @var array cURL transfer info
     */
    protected $transferInfo = array();

    /**
     * Initiates the cURL handle
     *
     * @throws CurlWrapperCurlException
     */
    public function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new CurlWrapperException('cURL extension is not loaded.');
        }

        $this->ch = curl_init();

        if (!$this->ch) {
            throw new CurlWrapperCurlException($this->ch);
        }

        $this->setDefaults();
    }

    /**
     * Closes and frees the cURL handle
     */
    public function __destruct()
    {
        if (is_resource($this->ch)) {
            curl_close($this->ch);
        }

        $this->ch = null;
    }

    /**
     * Adds a cookie for a cURL transfer
     *
     * Examples:
     * $curl->addCookie('user', 'admin');
     * $curl->addCookie(array('user'=>'admin', 'test'=>1));
     *
     * @param string|array $name Name of cookie or array of cookies (name=>value)
     * @param string $value Value of cookie
     */
    public function addCookie($name, $value = null)
    {
        if (is_array($name)) {
            $this->cookies = $name + $this->cookies;
        } else {
            $this->cookies[$name] = $value;
        }
    }

    /**
     * Adds a header for a cURL transfer
     *
     * Examples:
     * $curl->addHeader('Accept-Charset', 'utf-8;q=0.7,*;q=0.7');
     * $curl->addHeader('Pragma', '');
     * $curl->addHeader(array('Accept-Charset'=>'utf-8;q=0.7,*;q=0.7', 'Pragma'=>''));
     *
     * @param string|array $header Header or array of headers (header=>value)
     * @param string $value Value of header
     */
    public function addHeader($header, $value = null)
    {
        if (is_array($header)) {
            $this->headers = $header + $this->headers;
        } else {
            $this->headers[$header] = $value;
        }
    }

    /**
     * Adds an option for a cURL transfer (@see http://php.net/manual/en/function.curl-setopt.php)
     *
     * @param integer|array $option CURLOPT_XXX predefined constant or associative array of constants (constant=>value)
     * @param mixed $value Value of option
     */
    public function addOption($option, $value = null)
    {
        if (is_array($option)) {
            $this->options = $option + $this->options;
        } else {
            $this->options[$option] = $value;
        }
    }

    /**
     * Adds a request (GET/POST) parameter for a cURL transfer
     *
     * Examples:
     * $curl->addRequestParam('param', 'test');
     * $curl->addRequestParam('param=test&otherparam=123');
     * $curl->addRequestParam(array('param'=>'test', 'otherparam'=>123));
     *
     * @param string|array $name Name of parameter, query string or array of parameters (name=>value)
     * @param string $value Value of parameter
     */
    public function addRequestParam($name, $value = null)
    {
        if (is_array($name)) {
            $this->requestParams = $name + $this->requestParams;
        } elseif (is_string($name) && $value === null) {
            parse_str($name, $params);
            if (!empty($params)) {
                $this->requestParams = $params + $this->requestParams;
            }
        } else {
            $this->requestParams[$name] = $value;
        }
    }

    /**
     * Clears the cookies file
     */
    public function clearCookieFile()
    {
        if (!is_writable($this->cookieFile)) {
            throw new CurlWrapperException('Cookie file "'.($this->cookieFile).'" is not writable or does\'n exists!');
        }

        file_put_contents($this->cookieFile, '', LOCK_EX);
    }

    /**
     * Clears the cookies
     */
    public function clearCookies()
    {
        $this->cookies = array();
    }

    /**
     * Clears the headers
     */
    public function clearHeaders()
    {
        $this->headers = array();
    }

    /**
     * Clears the options
     */
    public function clearOptions()
    {
        $this->options = array();
    }

    /**
     * Clears the request parameters
     */
    public function clearRequestParams()
    {
        $this->requestParams = array();
    }

    /**
     * Makes the 'DELETE' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public function delete($url, $requestParams = null)
    {
        return $this->request($url, 'DELETE', $requestParams);
    }

    /**
     * Makes the 'GET' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public function get($url, $requestParams = null)
    {
        return $this->request($url, 'GET', $requestParams);
    }

    /**
     * Returns the last transfer's response data
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Gets the information about the last transfer
     *
     * If $key is given, returns its value. Otherwise, returns an associative array with the following elements:
     * url                      - Last effective URL
     * content_type             - Content-Type: of downloaded object, NULL indicates server did not send valid Content-Type: header
     * http_code                - Last received HTTP code
     * header_size              - Total size of all headers received
     * request_size             - Total size of issued requests, currently only for HTTP requests
     * filetime                 - Remote time of the retrieved document, if -1 is returned the time of the document is unknown
     * ssl_verify_result        - Result of SSL certification verification requested by setting CURLOPT_SSL_VERIFYPEER
     * redirect_count           - Number of redirects it went through if CURLOPT_FOLLOWLOCATION was set
     * total_time               - Total transaction time in seconds for last transfer
     * namelookup_time          - Time in seconds until name resolving was complete
     * connect_time             - Time in seconds it took to establish the connection
     * pretransfer_time         - Time in seconds from start until just before file transfer begins
     * size_upload              - Total number of bytes uploaded
     * size_download            - Total number of bytes downloaded
     * speed_download           - Average download speed
     * speed_upload             - Average upload speed
     * download_content_length  - content-length of download, read from Content-Length:  field
     * upload_content_length    - Specified size of upload
     * starttransfer_time       - Time in seconds until the first byte is about to be transferred
     * redirect_time            - Time in seconds of all redirection steps before final transaction was started
     * certinfo                 - There is official description for this field yet
     * request_header           - The request string sent. For this to work, add the CURLINFO_HEADER_OUT option
     *
     * @param string $key @see http://php.net/manual/en/function.curl-getinfo.php
     * @throws CurlWrapperException
     * @return array|string
     */
    public function getTransferInfo($key = null)
    {
        if (empty($this->transferInfo)) {
            throw new CurlWrapperException('There is no transfer info. Did you do the request?');
        }

        if ($key === null) {
            return $this->transferInfo;
        }

        if (isset($this->transferInfo[$key])) {
            return $this->transferInfo[$key];
        }

        throw new CurlWrapperException('There is no such key: '.$key);
    }

    /**
     * Makes the 'HEAD' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public function head($url, $requestParams = null)
    {
        return $this->request($url, 'HEAD', $requestParams);
    }

    /**
     * Makes the 'POST' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public function post($url, $requestParams = null)
    {
        return $this->request($url, 'POST', $requestParams);
    }

    /**
     * Makes the 'PUT' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public function put($url, $requestParams = null)
    {
        return $this->request($url, 'PUT', $requestParams);
    }

    /**
     * Makes the 'POST' request to the $url with raw $data
     * Use this method to send raw JSON, etc.
     *
     * @param string $url
     * @param string $data
     * @return string
     */
    public function rawPost($url, $data)
    {
        $this->prepareRawPayload($data);

        return $this->request($url, 'RAW_POST');
    }

    /**
     * Makes the 'PUT' request to the $url with raw $data
     * Use this method to send raw JSON, etc.
     *
     * @param string $url
     * @param string $data
     * @return string
     */
    public function rawPut($url, $data)
    {
        $this->prepareRawPayload($data);

        return $this->request($url, 'PUT');
    }

    /**
     * Removes the cookie for next cURL transfer
     *
     * @param string $name Name of cookie
     */
    public function removeCookie($name)
    {
        if (isset($this->cookies[$name])) {
            unset($this->cookies[$name]);
        }
    }

    /**
     * Removes the header for next cURL transfer
     *
     * @param string $header
     */
    public function removeHeader($header)
    {
        if (isset($this->headers[$header])) {
            unset($this->headers[$header]);
        }
    }

    /**
     * Removes the option for next cURL transfer
     *
     * @param integer $option CURLOPT_XXX predefined constant
     */
    public function removeOption($option)
    {
        if (isset($this->options[$option])) {
            unset($this->options[$option]);
        }
    }

    /**
     * Removes the request parameter for next cURL transfer
     *
     * @param string $name
     */
    public function removeRequestParam($name)
    {
        if (isset($this->requestParams[$name])) {
            unset($this->requestParams[$name]);
        }
    }

    /**
     * Makes the request of the specified $method to the $url with an optional $requestParams
     *
     * @param string $url
     * @param string $method
     * @param array $requestParams
     * @throws CurlWrapperCurlException
     * @return string
     */
    public function request($url, $method = 'GET', $requestParams = null)
    {
        $this->setURL($url);
        $this->setRequestMethod($method);

        if (!empty($requestParams)) {
            $this->addRequestParam($requestParams);
        }

        $this->initOptions();
        $this->response = curl_exec($this->ch);

        if ($this->response === false) {
            throw new CurlWrapperCurlException($this->ch);
        }

        $this->transferInfo = curl_getinfo($this->ch);

        return $this->response;
    }

    /**
     * Reinitiates the cURL handle
     * IMPORTANT: headers, options, request parameters, cookies and cookies file are remain untouched!
     */
    public function reset()
    {
        $this->__destruct();
        $this->transferInfo = array();
        $this->__construct();
    }

    /**
     * Reinitiates the cURL handle and resets all data
     * Including headers, options, request parameters, cookies and cookies file
     */
    public function resetAll()
    {
        $this->clearHeaders();
        $this->clearOptions();
        $this->clearRequestParams();
        $this->clearCookies();
        $this->clearCookieFile();
        $this->reset();
    }

    /**
     * Sets the number of seconds to wait while trying to connect, use 0 to wait indefinitely
     *
     * @param integer $seconds
     */
    public function setConnectTimeOut($seconds)
    {
        $this->addOption(CURLOPT_CONNECTTIMEOUT, $seconds);
    }

    /**
     * Sets the filename to store cookies
     *
     * @param string $filename
     * @throws CurlWrapperException
     */
    public function setCookieFile($filename)
    {
        if (!is_writable($filename)) {
            throw new CurlWrapperException('Cookie file "'.$filename.'" is not writable or does\'n exists!');
        }

        $this->cookieFile = $filename;
    }

    /**
     * Sets the default headers
     */
    public function setDefaultHeaders()
    {
        $this->headers = array(
            'Accept'          => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Charset'  => 'utf-8;q=0.7,*;q=0.7',
            'Accept-Language' => 'en-US,en;q=0.8',
            'Accept-Encoding' => 'gzip,deflate',
            'Keep-Alive'      => '300',
            'Connection'      => 'keep-alive',
            'Cache-Control'   => 'max-age=0',
            'Pragma'          => ''
        );
    }

    /**
     * Sets the default options
     */
    public function setDefaultOptions()
    {
        $this->options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_ENCODING       => 'gzip,deflate',
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 30,
        );
    }

    /**
     * Sets default headers, options and user agent if $userAgent is given
     *
     * @param string $userAgent Some predefined user agent name (ie, firefox, opera, etc.) or any string you want
     */
    public function setDefaults($userAgent = null)
    {
        $this->setDefaultHeaders();
        $this->setDefaultOptions();

        if (!empty($userAgent)) {
            $this->setUserAgent($userAgent);
        } else {
            $this->setUserAgent('chrome');
        }
    }

    /**
     * If $value is true sets CURLOPT_FOLLOWLOCATION option to follow any "Location: " header that the server
     * sends as part of the HTTP header (note this is recursive, PHP will follow as many "Location: " headers
     * that it is sent, unless CURLOPT_MAXREDIRS option is set).
     *
     * @param boolean $value
     */
    public function setFollowRedirects($value)
    {
        $this->addOption(CURLOPT_FOLLOWLOCATION, $value);
    }

    /**
     * Sets the contents of the "Referer: " header to be used in a HTTP request
     *
     * @param string $referer
     */
    public function setReferer($referer)
    {
        $this->addOption(CURLOPT_REFERER, $referer);
    }

    /**
     * Sets the maximum number of seconds to allow cURL functions to execute
     *
     * @param integer $seconds
     */
    public function setTimeout($seconds)
    {
        $this->addOption(CURLOPT_TIMEOUT, $seconds);
    }

    /**
     * Sets the contents of the "User-Agent: " header to be used in a HTTP request
     * You can use CurlWrapper's predefined shortcuts: 'ie', 'firefox', 'opera' and 'chrome'
     *
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        if (isset(self::$predefinedUserAgents[$userAgent])) {
            $this->addOption(CURLOPT_USERAGENT, self::$predefinedUserAgents[$userAgent]);
        } else {
            $this->addOption(CURLOPT_USERAGENT, $userAgent);
        }
    }

    /**
     * Sets the HTTP Authentication type.
     *
     * Defaults to CURLAUTH_BASIC.
     *
     * @param int $type
     */
    public function setAuthType($type = CURLAUTH_BASIC) {
        $this->addOption(CURLOPT_HTTPAUTH, $type);
    }

    /**
     * Sets the username and password for HTTP Authentication.
     *
     * @param string $username
     * @param string $password
     */
    public function setAuthCredentials($username, $password) {
        $this->addOption(CURLOPT_USERPWD, "$username:$password");
    }

    /**
     * Sets the value of cookieFile to empty string
     */
    public function unsetCookieFile()
    {
        $this->cookieFile = '';
    }

    /**
     * Builds url from associative array produced by parse_str() function
     *
     * @param array $parsedUrl
     * @return string
     */
    protected function buildUrl($parsedUrl)
    {
        return (isset($parsedUrl['scheme'])   ?     $parsedUrl["scheme"].'://' : '').
               (isset($parsedUrl['user'])     ?     $parsedUrl["user"].':'     : '').
               (isset($parsedUrl['pass'])     ?     $parsedUrl["pass"].'@'     : '').
               (isset($parsedUrl['host'])     ?     $parsedUrl["host"]         : '').
               (isset($parsedUrl['port'])     ? ':'.$parsedUrl["port"]         : '').
               (isset($parsedUrl['path'])     ?     $parsedUrl["path"]         : '').
               (isset($parsedUrl['query'])    ? '?'.$parsedUrl["query"]        : '').
               (isset($parsedUrl['fragment']) ? '#'.$parsedUrl["fragment"]     : '');
    }

    /**
     * Sets the final options and prepares request params, headers and cookies
     *
     * @throws CurlWrapperCurlException
     */
    protected function initOptions()
    {
        if (!empty($this->requestParams)) {
            if (isset($this->options[CURLOPT_HTTPGET])) {
                $this->prepareGetParams();
            } else {
                $this->addOption(CURLOPT_POSTFIELDS, http_build_query($this->requestParams));
            }
        }

        if (!empty($this->headers)) {
            $this->addOption(CURLOPT_HTTPHEADER, $this->prepareHeaders());
        }

        if (!empty($this->cookieFile)) {
            $this->addOption(CURLOPT_COOKIEFILE, $this->cookieFile);
            $this->addOption(CURLOPT_COOKIEJAR, $this->cookieFile);
        }

        if (!empty($this->cookies)) {
            $this->addOption(CURLOPT_COOKIE, $this->prepareCookies());
        }

        if (!curl_setopt_array($this->ch, $this->options)) {
            throw new CurlWrapperCurlException($this->ch);
        }
    }

    /**
     * Converts the cookies array to the correct string format
     *
     * @return string
     */
    protected function prepareCookies()
    {
        $cookiesString = '';

        foreach ($this->cookies as $cookie => $value) {
            $cookiesString .= $cookie.'='.$value.'; ';
        }

        return $cookiesString;
    }

    /**
     * Converts request parameters to the query string and adds it to the request url
     */
    protected function prepareGetParams()
    {
        $parsedUrl = parse_url($this->options[CURLOPT_URL]);
        $query = http_build_query($this->requestParams);

        if (isset($parsedUrl['query'])) {
            $parsedUrl['query'] .= '&'.$query;
        } else {
            $parsedUrl['query'] = $query;
        }

        $this->setUrl($this->buildUrl($parsedUrl));
    }

    /**
     * Sets up options for POST/PUT request with raw $data
     *
     * @param string $data
     */
    protected function prepareRawPayload($data)
    {
        $this->clearRequestParams();
        $this->addHeader('Content-Length', strlen($data));
        $this->addOption(CURLOPT_POSTFIELDS, $data);
    }

    /**
     * Converts the headers array to the cURL's option format array
     *
     * @return array
     */
    protected function prepareHeaders()
    {
        $headers = array();

        foreach ($this->headers as $header => $value) {
            $headers[] = $header.': '.$value;
        }

        return $headers;
    }

    /**
     * Sets the HTTP request method
     *
     * @param string $method
     */
    protected function setRequestMethod($method)
    {
        // Preventing request methods collision
        $this->removeOption(CURLOPT_NOBODY);
        $this->removeOption(CURLOPT_HTTPGET);
        $this->removeOption(CURLOPT_POST);
        $this->removeOption(CURLOPT_CUSTOMREQUEST);

        switch (strtoupper($method)) {
            case 'HEAD':
                $this->addOption(CURLOPT_NOBODY, true);
            break;

            case 'GET':
                $this->addOption(CURLOPT_HTTPGET, true);
            break;

            case 'POST':
                $this->addOption(CURLOPT_POST, true);
            break;

            case 'RAW_POST':
                $this->addOption(CURLOPT_CUSTOMREQUEST, 'POST');
            break;

            default:
                $this->addOption(CURLOPT_CUSTOMREQUEST, $method);
        }
    }

    /**
     * Sets the request url
     *
     * @param string $url Request URL
     */
    protected function setUrl($url)
    {
        $this->addOption(CURLOPT_URL, $url);
    }
}

/**
 * CurlWrapper Exceptions class
 */
class CurlWrapperException extends Exception
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}

/**
 * CurlWrapper cURL Exceptions class
 */
class CurlWrapperCurlException extends CurlWrapperException
{
    /**
     * @param resource $curlHandler
     */
    public function __construct($curlHandler)
    {
        $this->message = curl_error($curlHandler);
        $this->code = curl_errno($curlHandler);
    }
}