<?php

namespace HelloSign\Test;

use HelloSign\Client;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $keys = array(
            'API_KEY',
            'CLIENT_ID',
            'CLIENT_SECRET',
        	'API_URL',
        	'OAUTH_TOKEN_URL'
        );

        foreach ($keys as $key) {
            array_key_exists($key, $_SERVER) && $_ENV[$key] = $_SERVER[$key];
        }


        $api_url = $_ENV['API_URL'] == null ? Client::API_URL : $_ENV['API_URL'];
        $oauth_token_url = $_ENV['OAUTH_TOKEN_URL'] == null ? Client::OAUTH_TOKEN_URL : $_ENV['OAUTH_TOKEN_URL'];
        $this->client = new Client($_ENV['API_KEY'], null, $api_url, $api_token_url, $oauth_token_url);
        $this->team_member_1 = rand(1,10000000) . "@example.com";
        $this->team_member_2 = rand(1,10000000) . "@example.com";
     	//$this->client->enableDebugMode();
      
        if($api_url != Client::API_URL) {
        	$this->client->disableCertificateCheck();
        }
        
    }
}