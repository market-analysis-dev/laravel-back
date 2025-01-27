<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\BuildingFile;
use App\Services\FileService;
use Illuminate\Http\Request;

class BuildingFileController extends ApiController
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function uploadFiles(Request $request, Building $building)
    {
        $request->validate([
            'files.*' => 'required|file',
        ]);

        $uploadedFiles = $this->fileService->uploadFiles($request->file('files'), $building->id);

        foreach ($uploadedFiles as $file) {
            BuildingFile::updateOrCreate(
                [
                    'building_id' => $building->id,
                    'type' => $file['type'],
                ],
                [
                    'path' => $file['path'],
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                    'deleted_by' => auth()->id(),
                ]
            );
        }

        return $this->success('Files uploaded successfully');
    }
}
