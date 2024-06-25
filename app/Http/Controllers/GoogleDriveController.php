<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Illuminate\Http\Request;

class GoogleDriveController
{
    protected $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
    }

    public function getFileData($fileId)
    {
        $fileContent = $this->googleDriveService->getFile($fileId);

        // * Asumiendo que el archivo es CSV
        $data = array_map('str_getcsv', explode("\n", $fileContent));

        return response()->json($data);
    }
}