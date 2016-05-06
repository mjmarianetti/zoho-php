<?php

namespace Zoho\Api\Crm\Interfaces;

interface ClientInterface
{
    /** common *****/
    public function setAuthToken($authToken);
    public function getAuthToken();
    public function setScope($scope);
    public function getScope();
    /***************************/


    /********** get records *************/
    public function setSelectColumns($selectColumns);
    public function getSelectColumns();
    public function setFromIndex($fromIndex);
    public function getFromIndex();
    public function setToIndex($toIndex);
    public function getToIndex();
    public function setSortColumnString($sortColumnString);
    public function getSortColumnString();
    public function setSortOrderString($sortOrderString);
    public function getSortOrderString();
    public function setLastModifiedTime($lastModifiedTime);
    public function getLastModifiedTime();
    public function setNewFormat($newFormat);
    public function getNewFormat();
    public function setVersion($version);
    public function getVersion();
    /***************************/

    public function setId($id);
    public function getId($id);
    public function setIds($ids);
    public function getIds();

    //***** insert records *******
    public function setXmlData($xmlData);
    public function getXmlData();
    public function setWfTrigger($wfTrigger);
    public function getWfTrigger();
    public function setDuplicateCheck($duplicateCheck);
    public function getDuplicateCheck();
    public function setIsApproval($isApproval);
    public function getIsApproval();

    /** conver lead *********/
    public function setLeadId($leadId);
    public function getLeadId();
    /************************/

    /******** get related records **********/
    public function setParentModule($parentModule);
    public function getParentModule();
    /***************************************/

    /************ get fields *****************/
    public function setType($type);
    public function getType();
    /*****************************************/

    /************** get related modules ***********/
    public function setRelatedModule($relatedModule);
    public function getRelatedModule();
    /***********************************************/

    public function setContent($content);
    public function getContent();

    public function setRelatedId($relatedId);
    public function getRelatedId();

    public function setCriteria($criteria);
    public function getCriteria();

}
