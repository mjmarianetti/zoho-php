<?php

namespace Zoho;

use GuzzleHttp\Client;

class ZohoClient
{
    protected $baseUrl = 'https://crm.zoho.com/crm/private/json/';

    protected $scope = 'crmapi';

    protected $client;

    protected $url;

    protected $method;

    protected $httpMethod;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->baseUrl]);
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    /**
     * [buildUrl generate the URL].
     *
     * @param [type] $resource [Leads/Accounts etc]
     *
     * @return [string] [Url]
     */
    public function buildUrl($resource)
    {
        return $this->url.$resource.'/'.$this->method;
    }

    public function getRecords($resource, $params)
    {
        $this->method = __FUNCTION__;
        $this->httpMethod = 'GET';
        $this->call($resource, $params);
    }

    public function getResponse($response)
    {
        $result = json_decode($response);

        if (!isset($result)) {
            throw new Exception('No response from API - use rawResponse to get more details');
        }

        //$result->response->nodata;
        //$result->response->result->FL
        //$result->response->result->RESOURCE->row
        return $result->response;
    }

    public function call($resource, $params, $rawResponse = false)
    {
        $url = $this->buildUrl($resource);

        $params[] = ['scope' => $this->scope];

        $response = $this->client->request($this->httpMethod, $url, ['query' => $params]);

        if (!isset($response)) {
            throw new Exception('No response from API - use rawResponse to get more details');
        }

        if($response->getStatusCode() !== 200){
          throw new Exception($response->getBody());
        }

        if ($rawResponse) {
            return $response->getBody();
        }

        return $this->getResponse($response->getBody());
    }
}
