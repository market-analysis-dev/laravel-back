<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateConfigurationRequest;
use App\Http\Requests\UpdateKmzConfigurationRequest;
use App\Http\Resources\ConfigurationResource;
use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class ConfigurationController extends ApiController implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:configurations.index', only: ['index']),
            new Middleware('permission:configurations.update', only: ['update']),
            new Middleware('permission:configurations.uploadKmz', only: ['uploadKmz']),
        ];
    }

    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $configurations = Configuration::all();
        return $this->success(data: ConfigurationResource::collection($configurations));
    }

    /**
     * @param UpdateConfigurationRequest $request
     * @param Configuration $configuration
     * @return ApiResponse
     */
    public function update(UpdateConfigurationRequest $request, Configuration $configuration): ApiResponse
    {
        $validatedData = $request->validated();

        $configuration->update($validatedData);
        return $this->success('Configuration updated successfully', new ConfigurationResource($configuration));

    }

    /**
     * @param UpdateKmzConfigurationRequest $request
     * @param Configuration $configuration
     * @return ApiResponse
     */
    public function uploadKmz(UpdateKmzConfigurationRequest $request, Configuration $configuration): ApiResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('kmz')) {
            if ($configuration->file && Storage::exists($configuration->file->path)) {
                Storage::delete($configuration->file->path);
            }

            $uploadedFile = $request->file('kmz');
            $path = $uploadedFile->storeAs('kmz_files', $uploadedFile->getClientOriginalName(), 'public');

            $file = $configuration->file()->updateOrCreate([], [
                'name' => pathinfo($path, PATHINFO_FILENAME),
                'original_name' => $uploadedFile->getClientOriginalName(),
                'extension' => $uploadedFile->getClientOriginalExtension(),
                'size' => $uploadedFile->getSize(),
                'mime_type' => $uploadedFile->getMimeType(),
                'path' => $path,
            ]);
            $configuration->update(['file_id' => $file->id]);
        }

        $configuration->update([
            'description' => $validatedData['description'] ?? $configuration->description
        ]);

        return $this->success('KMZ configuration updated successfully', new ConfigurationResource($configuration));

    }
}
