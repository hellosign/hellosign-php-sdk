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
            'HELLOSIGN_CLIENT_SECRET'
        );

        foreach ($keys as $key) {
            array_key_exists($key, $_SERVER) && $_ENV[$key] = $_SERVER[$key];
        }

        $_ENV['TEAMMATE_ID_OR_EMAIL'] = 'email@example.com';

        $this->client = new Client($_ENV['HELLOSIGN_API_KEY']);
        // $this->client->enableDebugMode();
    }
}