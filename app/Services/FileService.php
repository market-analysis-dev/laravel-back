<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\BuildingFile;
use Illuminate\Http\UploadedFile;

class FileService
{
    /**
     * @param $files
     * @param int $buildingId
     * @param string|null $type
     * @return array
     */
    public function uploadFiles($files, int $buildingId, ?string $type = null): array
    {
        $result = [];

        // Если $files — это одиночный файл, преобразуем его в массив
        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            // Используем уже существующую логику
            $fileType = $type ?? $this->determineFileType($file->getClientOriginalName());

            if (!$fileType) {
                continue; // Пропускаем недопустимые типы
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
                'building_id' => $buildingId,
                'type' => $uploadedFile['type'],
                'file_id' => $fileRecord->id,
                'path' => $uploadedFile['path'],
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

        return $uploadedFilesInfo;
    }

    /**
     * @param UploadedFile $file
     * @param int $buildingId
     * @param string|null $type
     * @return array
     */
    public function uploadSingleTypeFile(UploadedFile $file, int $buildingId, ?string $type = null): array
    {
        $fileType = $type ?? $this->determineFileType($file->getClientOriginalName());

        if (!$fileType) {
            throw new \InvalidArgumentException("Invalid file type or file name: {$file->getClientOriginalName()}");
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
    private function determineFileType(string $fileName): ?string
    {
        $name = strtolower($fileName);

        if (str_contains($name, 'frontpage')) {
            return 'Front Page';
        } elseif (preg_match('/gallery[1-6]/', $name)) {
            return 'Gallery';
        } elseif (str_contains($name, 'aerial')) {
            return 'Aerial';
        } elseif (str_contains($name, '360')) {
            return '360';
        } elseif (str_contains($name, 'layout')) {
            return 'Layout';
        } elseif (str_contains($name, 'brochure') && str_ends_with($name, '.pdf')) {
            return 'Brochure';
        } elseif (str_ends_with($name, '.kmz')) {
            return 'KMZ';
        }

        return null; // Invalid or undetermined type
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
}
