<?php

namespace HelloSign\Test;

use HelloSign\Client;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $keys = array(
            'HELLOSIGN_API_KEY',
            'HELLOSIGN_CLIENT_ID',
            'HELLOSIGN_CLIENT_SECRET');

        foreach ($keys as $key) {
            array_key_exists($key, $_SERVER) && $_ENV[$key] = $_SERVER[$key];
        }


        $this->client = new Client($_ENV['HELLOSIGN_API_KEY']);
        $this->team_member_1 = rand(1,10000000) . "@example.com";
        $this->team_member_2 = rand(1,10000000) . "@example.com";
       // $this->client->enableDebugMode();
    }
}