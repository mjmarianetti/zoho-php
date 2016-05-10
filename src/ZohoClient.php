<?php

namespace Mjmarianetti\Zoho;

use GuzzleHttp\Client;
use Exception;

class ZohoClient
{
    protected $baseUrl;

    protected $scope;

    protected $client;

    protected $url;

    protected $method;

    protected $format;

    protected $httpMethod = 'POST';

    public function __construct($config)
    {
        $this->format = $config['format'];
        $this->baseUrl = $config['baseurl'] . $this->format.'/';
        $this->scope = $config['scope'];
        $this->authToken = $config['authtoken'];
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

    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
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
        return $this->baseUrl.$resource.'/'.$this->method;
    }

    public function getRecords($resource, $params = [])
    {
        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function getRecordById($resource, $params)
    {
        if (!isset($params['id']) && !isset($params['idlist'])) {
            throw new Exception('id or idlist is required');
        }

        if (isset($params['idlist'])) {
            //check if it is comma separated.
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function getMyRecords($resource, $params = [])
    {
        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    //response->result->DeletedIDs;
    public function getDeletedRecordIds($resource, $params = [])
    {
        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function getSearchRecordsByPDC($resource, $params)
    {
        if (!isset($params['selectColumns'])) {
            throw new Exception('selectColumns is required');
        }
        if (!isset($params['searchColumn'])) {
            throw new Exception('searchColumn is required');
        }
        if (!isset($params['searchValue'])) {
            throw new Exception('searchValue is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function deleteRecords($resource, $params)
    {
        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function getRelatedRecords($resource, $params)
    {
        if (!isset($params['parentModule'])) {
            throw new Exception('parentModule is required');
        }

        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function getFields($resource, $params)
    {
        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function getUsers($resource, $params)
    {
        if (!isset($params['type'])) {
            throw new Exception('type is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function delink($resource, $params)
    {
        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        if (!isset($params['relatedId'])) {
            throw new Exception('relatedId is required');
        }

        if (!isset($params['relatedModule'])) {
            throw new Exception('relatedModule is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function downloadFile($resource, $params)
    {
        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        $this->method = __FUNCTION__;
      return $this->call($resource, $params);
    }

    public function deleteFile($resource, $params)
    {
        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function downloadPhoto($resource, $params)
    {
        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function deletePhoto($resource, $params)
    {
        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function getModules($params)
    {
        if (!isset($params['id'])) {
            throw new Exception('id is required');
        }

        $this->method = __FUNCTION__;
        return $this->call('Info', $params);
    }

    public function searchRecords($resource, $params)
    {
        if (!isset($params['criteria'])) {
            throw new Exception('criteria is required');
        }

        $this->method = __FUNCTION__;
        return $this->call($resource, $params);
    }

    public function parseParams($params)
    {
        if (!$params || count($params) < 1) {
            throw new Exception('No params specified');
        }

        $queryParams = '';

        foreach ($params as $key => $value) {
            if ($queryParams === '' || strlen($queryParams) == 0) {
                $queryParams = $key.'='.$value;
            } else {
                $queryParams .= '&'.$key.'='.$value;
            }
        }

        return $queryParams;
    }

    public function call($resource, $params = [], $rawResponse = false)
    {
        $url = $this->buildUrl($resource);

        if (!isset($params['authtoken'])) {
            $params['authtoken'] = $this->authToken;
        }

        if (!isset($params['scope'])) {
            $params['scope'] = $this->scope;
        }

        /* Build url with parameters */
        $finalUrl = $url.'?'.$this->parseParams($params);

        $response = $this->client->post($finalUrl);

        if (!isset($response)) {
            throw new Exception('No response from API - use rawResponse to get more details');
        }

        if ($response->getStatusCode() !== 200) {
            throw new Exception($response->getBody());
        }

        if ($rawResponse) {
            return $response->getBody();
        }

        return $this->getResponse($response->getBody());
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
            return $result;
        }
}
