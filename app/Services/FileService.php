<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

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
     * Upload a single file for a building.
     * Type can be explicitly provided.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param int $buildingId
     * @param string|null $type
     * @return array
     */
    public function uploadSingleTypeFile($file, int $buildingId, ?string $type = null): array
    {
        // Use explicitly provided type or determine it from the file name
        $fileType = $type ?? $this->determineFileType($file->getClientOriginalName());

        if (!$fileType) {
            throw new \InvalidArgumentException("Invalid file type or file name: {$file->getClientOriginalName()}");
        }

        // Save the file to the appropriate folder
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
}
