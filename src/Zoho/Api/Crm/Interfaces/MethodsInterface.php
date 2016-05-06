<?php

namespace Zoho\Api\Crm\Interfaces;

interface MethodsInterface
{
    public function getMyRecords();
    public function getRecords();
    public function getRecordById();
    public function getDeletedRecordIds();
    public function insertRecords();
    public function updateRecords();
    public function getSearchRecordsByPDC();
    public function deleteRecords();
    public function convertLead();
    public function getRelatedRecords();
    public function getFields();
    public function updateRelatedRecords();
    public function getUsers();
    public function uploadFile();
    public function delink();
    public function downloadFile();
    public function deleteFile();
    public function uploadPhoto();
    public function downloadPhoto();
    public function deletePhoto();
    public function getModules();
    public function searchRecords();
}
