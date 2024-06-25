<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;

class GoogleDriveService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google/credentials.json'));
        $this->client->addScope(Google_Service_Drive::DRIVE);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getFile($fileId)
    {
        $service = new Google_Service_Drive($this->client);
        $response = $service->files->get($fileId, array(
            'alt' => 'media'
        ));
        return $response->getBody()->getContents();
    }
}