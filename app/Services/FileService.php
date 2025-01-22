<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * Create a new class instance.
     */
    public function uploadFiles($files, $buildingId)
    {
        $result = [];

        foreach ($files as $file) {
            $type = $this->determineFileType($file->getClientOriginalName());

            if (!$type) {
                continue; // * Ignorando archivos no válidos.
            }

            $path = "public/buildings/{buildingId}";
            $filename = $file->getClientOriginalName();

            Storage::putFileAs($path, $file, $filename);

            $result[] = [
                'type' => $type,
                'path' => $path . $filename,
            ];
        }

        return $result;
    }

    private function determineFileType($fileName)
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

        return null; // * Tipo no válido
    }
}
