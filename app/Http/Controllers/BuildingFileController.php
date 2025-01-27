<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\BuildingFile;
use App\Services\FileService;
use Illuminate\Http\Request;
use App\Models\File;

class BuildingFileController extends ApiController
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

   /* public function uploadFiles(Request $request, Building $building)
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
    }*/

    public function uploadFiles(Request $request, Building $building)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'required|file',
            'type' => 'nullable|string|in:Front Page,Gallery,Aerial,360,Layout',
        ]);

        $type = $request->input('type');
        $files = $request->file('files');

        if ($files instanceof \Illuminate\Http\UploadedFile) {
            $files = [$files];
        }

        foreach ($files as $file) {
            $uploadedFile = $this->fileService->uploadSingleTypeFile($file, $building->id, $type);

            $fileRecord = File::create([
                'name' => pathinfo($uploadedFile['path'], PATHINFO_FILENAME),
                'original_name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'path' => $uploadedFile['path'],
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
                'deleted_by' => null,
            ]);

            BuildingFile::create([
                'building_id' => $building->id,
                'type' => $uploadedFile['type'],
                'file_id' => $fileRecord->id,
                'path' => $uploadedFile['path'],
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
                'deleted_by' => null,
            ]);

            $uploadedFilesInfo[] = [
                'file_id' => $fileRecord->id,
                'building_id' => $building->id,
                'type' => $uploadedFile['type'],
                'original_name' => $file->getClientOriginalName(),
                'path' => $uploadedFile['path'],
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ];
        }

        return $this->success('Files uploaded successfully', $uploadedFilesInfo ?? null);
    }


}
