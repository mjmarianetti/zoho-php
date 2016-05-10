<?php

namespace Mjmarianetti\Zoho\Tests;

use Mjmarianetti\Zoho\ZohoClient;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf('Mjmarianetti\Zoho\ZohoClient', new ZohoClient());
    }
    public function testIsHttpClientCreated()
    {
        $client = new ZohoClient();
        $this->assertNotNull($client->getClient());
    }

    public function testGetLeadsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Leads');
        $this->assertNotNull($response);
    }

    public function testGetAccountsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Accounts');
        $this->assertNotNull($response);
    }

    public function testGetContactsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Contacts');
        $this->assertNotNull($response);
    }

    public function testGetPotentialsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Potentials');
        $this->assertNotNull($response);
    }

    public function testGetCampaignsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Campaigns');
        $this->assertNotNull($response);
    }

    public function testGetCasesRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Cases');
        $this->assertNotNull($response);
    }

    public function testGetSolutionsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Solutions'); //docs Soultions -> typo?
        $this->assertNotNull($response);
    }

    public function testGetProductsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Products');
        $this->assertNotNull($response);
    }

    public function testGetPriceBooksRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('PriceBooks');
        $this->assertNotNull($response);
    }

    public function testGetAccountsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Accounts');
        $this->assertNotNull($response);
    }

    public function testGetQuotesRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Quotes');
        $this->assertNotNull($response);
    }

    public function testGetInvoicesRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Invoices');
        $this->assertNotNull($response);
    }

    public function testGetSalesOrdersRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('SalesOrders');
        $this->assertNotNull($response);
    }

    public function testGetVendorsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Vendors');
        $this->assertNotNull($response);
    }

    public function testGetPurchaseOrdersRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('PurchaseOrders');
        $this->assertNotNull($response);
    }

    public function testGetEventsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Events');
        $this->assertNotNull($response);
    }

    public function testGetTasksRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Tasks');
        $this->assertNotNull($response);
    }

    public function testGetCallsRecords()
    {
        $client = new ZohoClient();
        $response = $client->getRecords('Calls');
        $this->assertNotNull($response);
    }
}
