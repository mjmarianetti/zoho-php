# zoho-php
PHP wrapper for Zoho with Laravel 5.* support

PACKAGE UNDER DEVELOPMENT, NOT ALL METHODS DOCUMENTED

# Installation

To install this package you must modify your `composer.json` file and run `composer update`

    "require": {
        "mjmarianetti/zoho-php": "dev-master"
      }

Or you can run the `composer require mjmarianetti/zoho-php`

# Laravel

Open `config/app.php` and register the required service provider

    'providers' => [
      ...
      Mjmarianetti\Zoho\ZohoServiceProvider::class

    ]

Then you should publish the config file

    php artisan vendor:publish --provider="Mjmarianetti\Zoho\ZohoServiceProvider"


# Configuration

You can configure the options provided in you `.env` file.

    ZOHO_SCOPE=crmapi
    ZOHO_AUTHTOKEN=<INSERT-YOUR-TOKEN-HERE>
    ZOHO_FORMAT=json

The default options are:

    ZOHO_SCOPE=crmapi
    ZOHO_FORMAT=json

# Usage

## Initialization

Include the `ZohoClient` in your project/file

    use Mjmarianetti\Zoho\ZohoClient;

If you are using Laravel you can inject it as a dependency

    public function test(ZohoClient $client)
    {

Or if you are using it as a stand-alone library or with another framework, you have to provide a default configuration like:

    $config = [
      'authtoken' => 'YOUR-TOKEN',
      'scope' => 'crmapi',
      'format' => 'json', // or xml
      'baseurl' => 'https://crm.zoho.com/crm/private/'
    ];

    $client = new ZohoClient($config);

## Methods

After initialization you can call the API.

All this methods follow the same pattern, where `$resource` is the Module you want to call, and `$params` all the parameters that you want to use.

The response returned usually follows the pattern:
    $result = $client->getRecords(RESOURCE,$params);

    $result->response->nodata;
    $result->response->result->FL
    $result->response->result->RESOURCE->row

### Available $resource values

API format --> https://www.zoho.com/crm/help/api/modules-fields.html


### getRecords

https://www.zoho.com/crm/help/api/getrecords.html

    $client->getRecords($resource, $params = [])

### getRecordsById

https://www.zoho.com/crm/help/api/getrecordbyid.html

`$params` should contain either `id` or `idlist` value.

    $client->getRecordsById($resource, $params = [])


Note: `idlist` should be a unique set of Ids separated by semicolon, up to 100 values

### getMyRecords

https://www.zoho.com/crm/help/api/getmyrecords.html

    $client->getMyRecords($resource, $params = [])


### getDeletedRecordIds

https://www.zoho.com/crm/help/api/getdeletedrecordids.html

    $client->getDeletedRecordIds($resource, $params = [])

    //response->result->DeletedIDs;


### getSearchRecordsByPDC

https://www.zoho.com/crm/help/api/getsearchrecordsbypdc.html

    $client->getSearchRecordsByPDC($resource, $params = [])

### deleteRecords

https://www.zoho.com/crm/help/api/deleterecords.html

      $client->deleteRecords($resource, $params = [])

### getRelatedRecords

https://www.zoho.com/crm/help/api/getrelatedrecords.html

    $client->getRelatedRecords($resource, $params = [])

### getFields

https://www.zoho.com/crm/help/api/getfields.html

    $client->getFields($resource, $params = [])

### getUsers

https://www.zoho.com/crm/help/api/getusers.html

    $client->getUsers($resource, $params = [])


### delink

https://www.zoho.com/crm/help/api/delink.html

    $client->delink($resource, $params = [])


### downloadFile

https://www.zoho.com/crm/help/api/downloadfile.html

    $client->downloadFile($resource, $params = [])

### deleteFile

https://www.zoho.com/crm/help/api/deletefile.html

    $client->deleteFile($resource, $params = [])

### downloadPhoto

https://www.zoho.com/crm/help/api/downloadphoto.html

    $client->downloadPhoto($resource, $params = [])

### deletePhoto

https://www.zoho.com/crm/help/api/deletephoto.html

    $client->deletePhoto($resource, $params = [])

### getModules

https://www.zoho.com/crm/help/api/getmodules.html

    $client->getModules($resource, $params = [])

### searchRecords

https://www.zoho.com/crm/help/api/searchrecords.html

    $client->searchRecords($resource, $params = [])


## Iterator

If you would like to use a iterator to loop through the data received, you can use it like this:

    use Mjmarianetti\Zoho\Helpers\ZohoResponseIterator;
    use Mjmarianetti\Zoho\ZohoClient;

    ...
    $response = $zc->getRecords('Accounts', []);

    $it = new ZohoResponseIterator((array) $response->response->result->Accounts->row);
    $resultados = [];
    foreach ($it as $key => $value) {
        //$value->val and $value->content;      
    }

For now, you should check that `$response->response->result->Resource->row` is set
