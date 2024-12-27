<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuilderRequest;
use App\Http\Requests\UpdateBuilderRequest;
use App\Models\Builder;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class BuilderController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $builders = Builder::all();
        return $this->success(data: $builders);
    }

    /**
     * @param StoreBuilderRequest $request
     * @return ApiResponse
     */
    public function store(StoreBuilderRequest $request): ApiResponse
    {
        $builder = Builder::create($request->validated());
        return $this->success('Builder created successfully', $builder);
    }

    /**
     * @param UpdateBuilderRequest $request
     * @param Builder $builder
     * @return ApiResponse
     */
    public function update(UpdateBuilderRequest $request, Builder $builder): ApiResponse
    {
        try {
            if ($builder->update($request->validated())) {
                return $this->success('Builder updated successfully', $builder);
            }

            return $this->error('Builder update failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @param Builder $builder
     * @return ApiResponse
     */
    public function destroy(Builder $builder): ApiResponse
    {
        try {
            if ($builder->delete()) {
                return $this->success('Builder deleted successfully', $builder);
            }
            return $this->error('Builder delete failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
