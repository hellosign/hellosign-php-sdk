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
 * Comvi CURL Class.
 *
 * Work with remote servers via cURL much easier than using the native PHP bindings.
 * forked from https://github.com/comvi/curl
 */
class CURL {
    //protected $session;           // Contains the cURL handler for a session
    protected $url;                 // URL of the session
    protected $options = array();   // Populates curl_setopt_array
    protected $headers = array();   // Populates extra HTTP headers
    protected $error_code;          // Error code returned as an int
    protected $error_string;        // Error message returned as a string
    protected $info;                // Returned after request (elapsed time, etc)
    protected $response;            // Contains the cURL response for debug

    function __construct($url = null)
    {
        if (!$this->isEnabled()) {
            throw new \Exception ('LIB_CURL_ERROR_PHP_WAS_NOT_BUILT_WITH_CURL');
        }

        if ($url !== null) {
            // If no a protocol in URL, assume its a CI link
            /*if (!preg_match('!^\w+://! i', $url)) {
                $url = site_url($url);
            }*/
            $this->url = $url;
        }
    }

    public function get($params = array(), $single_use_options = array())
    {
        $options = array() + $single_use_options;

        if (!empty($params)) {
            $options[CURLOPT_URL] = $this->url.'?'.http_build_query($params, NULL, '&');
        }
        
        return $this->execute($options);
    }

    public function post($params = array(), $single_use_options = array())
    {
        $options = array(
            CURLOPT_POST            => true,
            CURLOPT_POSTFIELDS        => static::to_1_level_array($params)
        ) + $single_use_options;

        return $this->execute($options);
    }

    public function put($params = array(), $single_use_options = array())
    {
        $options = array(
            CURLOPT_CUSTOMREQUEST    => 'PUT',
            // Override method, I think this overrides $_POST with PUT/DELETE data but... we'll see eh?
            CURLOPT_HTTPHEADER        => array('X-HTTP-Method-Override: PUT'),
            CURLOPT_POSTFIELDS        => static::to_1_level_array($params)
        ) + $single_use_options;

        return $this->execute($options);
    }

    public function delete($params = array(), $single_use_options = array())
    {
        $options = array(
            CURLOPT_CUSTOMREQUEST    => 'DELETE',
            CURLOPT_HTTPHEADER        => array('X-HTTP-Method-Override: DELETE'),
            CURLOPT_POSTFIELDS        => static::to_1_level_array($params)
        ) + $single_use_options;

        return $this->execute($options);
    }

    // End a session and return the results
    public function execute($options = array())
    {
        // Set two default options, and merge any extra ones in
        if (!isset($this->options[CURLOPT_TIMEOUT])) {
            $this->options[CURLOPT_TIMEOUT] = 30;
        }

        if (!isset($this->options[CURLOPT_RETURNTRANSFER])) {
            $this->options[CURLOPT_RETURNTRANSFER] = true;
        }

        if (!isset($this->options[CURLOPT_FAILONERROR])) {
            $this->options[CURLOPT_FAILONERROR] = true;
        }

        // Only set follow location if not running securely
        if (!isset($this->options[CURLOPT_FOLLOWLOCATION]) && !ini_get('safe_mode') && ! ini_get('open_basedir')) {
            $this->options[CURLOPT_FOLLOWLOCATION] = true;
        }

        if (!empty($this->headers)) {
            $headers = array();

            foreach ($this->headers as $key => $header) {
                $headers[] = is_int($key) ? $header : $key.': '.$header;
            }

            $this->setOption(CURLOPT_HTTPHEADER, $headers);
        }

        $this->setOption(CURLOPT_URL, $this->url);
        

        $ch = curl_init();

        // Set all options provided
        foreach ($this->options as $key => $option) {
            if (!array_key_exists($key, $options)) {
                $options[$key] = $option;
            }
        }
        //print_r($options);die();
        curl_setopt_array($ch, $options);

        // Execute the request & and hide all output
        $this->response    = curl_exec($ch);
        $this->info        = curl_getinfo($ch);

        // Request failed
        if ($this->response === false) {
            $this->error_code    = curl_errno($ch);
            $this->error_string    = curl_error($ch);
        }

        curl_close($ch);

        return $this->response;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setOptions($options = array())
    {
        // Merge options in with the rest - done as array_merge() does not overwrite numeric keys
        foreach ($options as $option_code => $option_value) {
            $this->setOption($option_code, $option_value);
        }
    }

    public function setOption($code, $value)
    {
        if (is_string($code)) {
            $code = constant('CURLOPT_' . strtoupper($code));
        }

        $this->options[$code] = $value;
    }

    public function setHeader($header, $content = null)
    {
        if ($content !== null) {
            $this->headers[$header] = $content;
        }
        else {
            $this->headers[] = $header;
        }
    }

    public function setCookies($params = array())
    {
        if (is_array($params)) {
            $params = http_build_query($params, null, '&');
        }

        $this->setOption(CURLOPT_COOKIE, $params);
    }

    public function setLogin($username = '', $password = '', $type = 'any')
    {
        $this->setOption(CURLOPT_USERPWD, $username . ':' . $password);
    }

    public function setProxy($url = '', $port = 80)
    {
        $this->setOption(CURLOPT_HTTPPROXYTUNNEL, true);
        $this->setOption(CURLOPT_PROXY, $url . ':' . $port);
        return $this;
    }

    public function setProxyLogin($username = '', $password = '')
    {
        $this->setOption(CURLOPT_PROXYUSERPWD, $username . ':' . $password);
        return $this;
    }

    public function setSSL($verify_peer = true, $verify_host = 2, $path_to_cert = null)
    {
        if ($verify_peer) {
            $this->setOption(CURLOPT_SSL_VERIFYPEER, true);
            $this->setOption(CURLOPT_SSL_VERIFYHOST, $verify_host);
            $this->setOption(CURLOPT_CAINFO, $path_to_cert);
        }
        else {
            $this->setOption(CURLOPT_SSL_VERIFYPEER, false);
        }
    }

    public function fakeUserAgent()
    {
        $this->setOption(CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    }

    public function isEnabled()
    {
        return function_exists('curl_init');
    }

    public function enableDebug()
    {
        $this->setOption(CURLOPT_VERBOSE, true);
    }

    public function debug()
    {
        echo "=============================================<br/>\n";
        echo "<h2>CURL Test</h2>\n";
        echo "=============================================<br/>\n";
        echo "<h3>Response</h3>\n";
        echo "<code>" . nl2br(htmlentities($this->response)) . "</code><br/>\n\n";

        if ($this->error_string)
        {
            echo "=============================================<br/>\n";
            echo "<h3>Errors</h3>";
            echo "<strong>Code:</strong> " . $this->error_code . "<br/>\n";
            echo "<strong>Message:</strong> " . $this->error_string . "<br/>\n";
        }

        echo "=============================================<br/>\n";
        echo "<h3>Info</h3>";
        echo "<pre>";
        print_r($this->info);
        echo "</pre>";
    }

    // Return HTTP status code
    public function getStatus()
    {
        return $this->getInfo('http_code');
    }

    // Return raw response
    public function getResponse()
    {
        return $this->response;
    }

    // Return error code
    public function getErrorCode()
    {
        return $this->error_code;
    }

    // Return error string
    public function getError()
    {
        return $this->error_string;
    }

    // Return curl info by specified key, or whole array
    public function getInfo($key = null)
    {
        if ($key === null) {
            return $this->info;
        }

        if (isset($this->info[$key])) {
            return $this->info[$key];
        }

        return null;
    }

    public function reset()
    {
        $this->headers = array();
        $this->options = array();
        $this->error_code = null;
        $this->error_string = null;
        $this->response = null;
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

            if (is_array($value) || (is_object($value) && get_class($value) != 'CURLFile')) {
                $return += static::to_1_level_array($value, $name);
            }
            else {
                $return[$name] = $value;
            }
        }

        return $return;
    }
}