<?php

namespace Tests;

use Zoho\ZohoClient;
use Dotenv\Dotenv;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    protected $params;

    public function setUp()
    {
      $dotenv = new Dotenv(__DIR__);
      $dotenv->load();
      $dotenv->required('AUTHTOKEN')->notEmpty();
      $this->params = ['authtoken' => getenv('AUTHTOKEN')];
    }

    public function testCanCreateInstance()
    {
        $this->assertInstanceOf('Zoho\ZohoClient', new ZohoClient());
    }

    public function testIsHttpClientCreated()
    {
        $client = new ZohoClient();
        $this->assertNotNull($client->getClient());
    }

    /*public function testCallLeadsMethod()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Leads', $this->params,false);
    }

    public function testCallAccountsMethod()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Accounts', $this->params,false);
    }*/
}
