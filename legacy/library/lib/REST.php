<?php
namespace Comvi;

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

/**
 * Comvi REST Class.
 *
 * Make REST requests to RESTful services with simple syntax.
 * forked from https://github.com/comvi/rest
 */

class REST
{
    protected $supported_formats = array(
        'xml'               => 'application/xml',
        'json'              => 'application/json',
        'serialize'         => 'application/vnd.php.serialized',
        'php'               => 'text/plain',
        'csv'               => 'text/csv'
    );

    protected $auto_detect_formats = array(
        'application/xml'   => 'xml',
        'text/xml'          => 'xml',
        'application/json'  => 'json',
        'text/json'         => 'json',
        'text/csv'          => 'csv',
        'application/csv'   => 'csv',
        'application/vnd.php.serialized' => 'serialize'
    );

    protected $guzzleClient;
    protected $headers = [];
    protected $statusCode;

    protected $server;
    protected $ca_info;
    protected $auth = 'any';
    protected $user;
    protected $pass;

    protected $is_https = false;
    protected $debug_mode = false;

    protected $format;
    protected $mime_type;


    function __construct($config = array(), $http_options = array())
    {
        // If a URL was passed to the library
        empty($config) OR $this->initialize($config);

        $default_http_options = ['connect_timeout' => 300.0, 'timeout' => 30.0, 'allow_redirects' => true];
        if (!empty($this->server)) {
            $default_http_options['base_uri'] = $this->server;
        }

        $this->guzzleClient = new \GuzzleHttp\Client(array_merge($default_http_options, $http_options));
    }

    public function initialize($config)
    {
        isset($config['server']) AND $this->server = $config['server'];
        isset($config['auth']) AND $this->auth = $config['auth'];
        isset($config['user']) AND $this->user = $config['user'];
        isset($config['pass']) AND $this->pass = $config['pass'];
        isset($config['debug_mode']) AND $this->debug_mode = $config['debug_mode'];

        if (substr($this->server, 0, 5) === 'https') {
            $this->is_https = true;
            isset($config['ca_info']) AND $this->ca_info = $config['ca_info'];
        }
    }

    public function get($uri, $params = array(), $format = null)
    {
        return $this->call('get', $uri, $params, $format);
    }

    public function post($uri, $params = array(), $format = null)
    {
        return $this->call('post', $uri, $params, $format);
    }

    public function delete($uri, $params = array(), $format = null)
    {
        return $this->call('delete', $uri, $params, $format);
    }

    protected function call($method, $uri, $params = array(), $format = null)
    {
        if ($format !== null) {
            $this->format($format);
        }

        $options = [];

        if ($this->mime_type !== null) {
            $options['headers'] = array_merge($this->headers, ['Accept' => $this->mime_type]);
        }

        if ($this->is_https === true) {
            if (empty($this->ca_info)) {
                $options['verify'] = false;
            }
            else {
                $options['verify'] = $this->ca_info;
            }
        }

        // If authentication is enabled use it
        if ($this->auth != '' && $this->user != '') {
            $options['auth'] = [$this->user, $this->pass];
        }

        // If we have an oauth token, push to guzzle client
        # https://stackoverflow.com/questions/38029422/php-guzzle-with-basic-auth-and-bearer-token
        if (!empty($this->headers['Authorization'])) {
            $options['headers']['Authorization'] = $this->headers['Authorization'];
        }

        if ($this->debug_mode === true) {
            $options['debug'] = true;
        }

        // We still want the response even if there is an error code over 400
        $options['http_errors'] = false;

        // Call the correct method with parameters
        if (!empty($params)) {
            if (strtoupper($method) == 'POST') {
                $options['multipart'] = [];
                foreach (self::to_1_level_array($params) as $name => $value) {
                    $options['multipart'][] = ['name' => $name, 'contents' => $value];
                }
            } else {
                $options['query'] = $params;
            }
        }

        // Execute and return the response from the REST server
        $response = $this->guzzleClient->{$method}($uri, $options);
        $this->statusCode = $response->getStatusCode();

        // Format and return
        $contentType = $response->hasHeader('Content-Type') ? current($response->getHeader('Content-Type')) : '';
        return $this->formatResponse((string)$response->getBody(), $contentType);
    }

    public function setApiKey($key, $name = 'X-API-KEY')
    {
        $this->setHeader($name, $key);
    }

    public function acceptLanguage($lang)
    {
        if (is_array($lang)) {
            $lang = implode(', ', $lang);
        }

        $this->setHeader('Accept-Language', $lang);
    }

    public function setHeader($name, $content = null)
    {
        $this->headers[$name] = $content;
    }

    public function enableDebugMode()
    {
        $this->debug_mode = true;
    }

    public function disableDebugMode()
    {
        $this->debug_mode = false;
    }

    public function disableCertificateCheck() {
        $this->ca_info = null;
    }

    // If a type is passed in that is not supported, use it as a mime type
    public function format($format)
    {
        if (array_key_exists($format, $this->supported_formats)) {
            $this->format = $format;
            $this->mime_type = $this->supported_formats[$format];
        }
        else {
            $this->mime_type = $format;
        }
    }

    // Return HTTP status code
    public function getStatus()
    {
        return $this->statusCode;
    }

    protected function formatResponse($response, $contentType)
    {
        // It is a supported format, so just run its formatting method
        if (array_key_exists($this->format, $this->supported_formats)) {
            return $this->{'_'.$this->format}($response);
        }

        if (array_key_exists($contentType, $this->auto_detect_formats)) {
            return $this->{'_'.$this->auto_detect_formats[$contentType]}($response);
        }

        return $response;
    }


    // Format XML for output
    protected function _xml($string)
    {
        return $string ? (array) simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA) : array();
    }

    // Format HTML for output
    // This function is DODGY! Not perfect CSV support but works with my REST_Controller
    protected function _csv($string)
    {
        $data = array();

        // Splits
        $rows = explode("\n", trim($string));
        $headings = explode(',', array_shift($rows));
        foreach ($rows as $row) {
            // The substr removes " from start and end
            $data_fields = explode('","', trim(substr($row, 1, -1)));

            if (count($data_fields) === count($headings)) {
                $data[] = array_combine($headings, $data_fields);
            }

        }

        return $data;
    }

    // Encode as JSON
    protected function _json($string)
    {
        return json_decode(trim($string));
    }

    // Encode as Serialized array
    protected function _serialize($string)
    {
        return unserialize(trim($string));
    }

    // Encode raw PHP
    protected function _php($string)
    {
        $string = trim($string);
        $populated = array();
        eval("\$populated = \"$string\";");
        return $populated;
    }

    /**
     * Convert nested array to 1 level array
     *
     * @param  array $array
     * @param  string $prefix
     * @return array
     */
    public static function to_1_level_array($array, $prefix = null)
    {
        $return = array();

        foreach ($array as $key => $value) {
            $name = $prefix ? "{$prefix}[{$key}]" : $key;

            if (is_array($value) || is_object($value)) {
                $return += self::to_1_level_array($value, $name);
            }
            else {
                $return[$name] = $value;
            }
        }

        return $return;
    }
}
