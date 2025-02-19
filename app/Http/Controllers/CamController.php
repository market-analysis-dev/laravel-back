<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCamRequest;
use App\Http\Requests\UpdateCamRequest;
use App\Models\Cam;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class CamController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $cams = Cam::all();
        return $this->success(data: $cams);
    }

    /**
     * @param StoreCamRequest $request
     * @return ApiResponse
     */
    public function store(StoreCamRequest $request): ApiResponse
    {
        $cam = Cam::create($request->validated());
        return $this->success('Cam created successfully', $cam);
    }

    /**
     * @param Cam $cam
     * @return ApiResponse
     */
    public function show(Cam $cam): ApiResponse
    {
        return $this->success(data: $cam);
    }

    /**
     * @param UpdateCamRequest $request
     * @param Cam $cam
     * @return ApiResponse
     */
    public function update(UpdateCamRequest $request, Cam $cam): ApiResponse
    {
        try {
            if ($cam->update($request->validated())) {
                return $this->success('Cam updated successfully', $cam);
            }

            return $this->error('Cam update failed', status:423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }

    /**
     * @param Cam $cam
     * @return ApiResponse
     */
    public function destroy(Cam $cam): ApiResponse
    {
        try {
            if ($cam->delete()) {
                return $this->success('Cam deleted successfully', $cam);
            }
            return $this->error('Cam delete failed', status:423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }
}
