<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\BuildingFile;
use Illuminate\Http\UploadedFile;
use App\Services\ImageOptimizationService;

class FileService
{
    private ImageOptimizationService $imageOptimizationService;

    public function __construct(ImageOptimizationService $imageOptimizationService)
    {
        $this->imageOptimizationService = $imageOptimizationService;
    }
    /**
     * @param $files
     * @param int $buildingId
     * @param string|null $type
     * @return array
     */
    public function uploadFiles($files, int $buildingId, ?string $type = null): array
    {
        $result = [];

        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            $fileType = $type ?? $this->determineFileType($file->getClientOriginalName());

            if (!$fileType) {
                continue;
            }

            $path = "public/buildings/{$buildingId}/{$fileType}/";
            $filename = $file->getClientOriginalName();

            Storage::putFileAs($path, $file, $filename);

            $result[] = [
                'type' => $fileType,
                'path' => $path . $filename,
            ];
        }

        return $result;
    }

    /**
     * @param array $files
     * @param int $buildingId
     * @param string|null $type
     * @return array
     */
    public function uploadBuildingFiles(array $files, int $buildingId, ?string $type = null): array
    {
        $uploadedFilesInfo = [];

        foreach ($files as $file) {

            $uploadedFile = $this->uploadSingleTypeFile($file, $buildingId, $type);

            if($uploadedFile) {
                if (str_starts_with($file->getMimeType(), 'image/')) {
                    $fullPath = storage_path('app/' . $uploadedFile['path']);
                    $this->imageOptimizationService->optimize($fullPath);
                }

                $fileRecord = File::create([
                    'name' => pathinfo($uploadedFile['path'], PATHINFO_FILENAME),
                    'original_name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'path' => str_replace('public/', '', $uploadedFile['path']),
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                    'deleted_by' => null,
                ]);


                BuildingFile::create([
                    'building_id' => $buildingId,
                    'type' => $uploadedFile['type'],
                    'file_id' => $fileRecord->id,
                    //'path' => str_replace('public/', '', $uploadedFile['path']),
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                    'deleted_by' => null,
                ]);

                $uploadedFilesInfo[] = [
                    'file_id' => $fileRecord->id,
                    'building_id' => $buildingId,
                    'type' => $uploadedFile['type'],
                    'original_name' => $file->getClientOriginalName(),
                    'path' => $uploadedFile['path'],
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }
        }

        return $uploadedFilesInfo;
    }

    /**
     * @param UploadedFile $file
     * @param int $buildingId
     * @param string|null $type
     * @return array
     */
    public function uploadSingleTypeFile(UploadedFile $file, int $buildingId, ?string $type = null): ?array
    {
        $fileType = $type ?? $this->determineFileType($file->getClientOriginalName());

        if (!$fileType) {
            //throw new \InvalidArgumentException("Invalid file type or file name: {$file->getClientOriginalName()}");
            return null;
        }

        $path = "public/buildings/{$buildingId}/";
        $filename = $file->getClientOriginalName();

        Storage::putFileAs($path, $file, $filename);

        return [
            'type' => $fileType,
            'path' => $path . $filename,
        ];
    }

    /**
     * Determine file type based on its name.
     *
     * @param string $fileName
     * @return string|null
     */
    /*private function determineFileType(string $fileName): ?string
    {
        $name = strtolower($fileName);

        if (str_contains($name, 'frontpage')) {
            return 'Front Page';
        } elseif (preg_match('/^gallery[1-6]/', $name)) {
            return 'Gallery';
        } elseif (str_starts_with($name, 'aerial')) {
            return 'Aerial';
        } elseif (str_starts_with($name, '360')) {
            return '360';
        } elseif (str_starts_with($name, 'layout')) {
            return 'Layout';
        } elseif (str_starts_with($name, 'brochure') && str_ends_with($name, '.pdf')) {
            return 'Brochure';
        } elseif (str_ends_with($name, '.kmz')) {
            return 'KMZ';
        }

        return null; // Invalid or undetermined type
    }*/
    private function determineFileType(string $fileName): ?string
    {
        $name = strtolower($fileName);
        $extension = pathinfo($name, PATHINFO_EXTENSION);

        // 1. Portada → Frontpage
        if (str_contains($name, 'portada')) {
            return 'Frontpage';
        }

        // 2. 1-6 → Pictures
        if (preg_match('/\b[1-6]\b/', $name) && in_array($extension, ['jpg', 'jpeg', 'png'])) {
            return 'Pictures';
        }

        // 3. other
        $mapping = [
            '360aerial'   => '360Aerial',
            '360interior' => '360Interior',
            'layout'      => 'Layout',
            'brochure'    => 'Brochure',
            'kmz'         => 'KMZ',
        ];

        foreach ($mapping as $keyword => $type) {
            if (str_contains($name, $keyword)) {
                return $type;
            }
        }

        return null;
    }


    /**
     * @param $buildingId
     * @param null $type
     * @return array
     */
    public function deleteBuildingFiles($buildingId, $type = null)
    {
        $query = BuildingFile::where('building_id', $buildingId);

        if ($type) {
            $query->where('type', $type);
        } else {
            $type = $this->determineFileType($file->getClientOriginalName());
        }

        $files = $query->get();

        if ($files->isEmpty()) {
            return [
                'message' => 'No files found for deletion',
                'deleted_files' => [],
            ];
        }

        $deletedFiles = [];

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->path);
            $deletedFiles[] = [
                'id' => $file->id,
                'name' => $file->name,
                'path' => $file->path,
                'type' => $file->type,
            ];
            $file->delete();
        }

        return [
            'message' => 'Files deleted successfully',
            'deleted_files' => $deletedFiles,
        ];
    }

    /**
     * @param array $files
     * @param int $buildingId
     * @return array
     */
    public function deleteBuildingFilesByType(array $files, int $buildingId)
    {
        $query = BuildingFile::where('building_id', $buildingId);
        $types = [];
        foreach ($files as $file) {
            $type = $this->determineFileType($file->getClientOriginalName());
            $types[] = $type;
        }
        $query->whereIn('type', $types);
        $result = $query->get();
        if ($result->isEmpty()) {
            return [
                'message' => 'No files found for deletion',
                'deleted_files' => [],
            ];
        }

        $deletedFiles = [];

        foreach ($result as $file) {
            Storage::disk('public')->delete($file->path);
            $deletedFiles[] = [
                'id' => $file->id,
                'name' => $file->name,
                'path' => $file->path,
                'type' => $file->type,
            ];
            $file->delete();
        }

        return [
            'message' => 'Files deleted successfully',
            'deleted_files' => $deletedFiles,
        ];
    }
}
