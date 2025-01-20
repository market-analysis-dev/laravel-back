<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLandAvailableRequest;
use App\Http\Requests\UpdateLandAvailableRequest;
use App\Models\Land;
use App\Models\LandAvailable;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class LandAvailableController extends ApiController
{
    /**
     * @param Land $land
     * @return ApiResponse
     */
    public function index(Land $land): ApiResponse
    {
        $landsAvailable = LandAvailable::where('land_id', $land->id)
            ->where('land_state', '=', 'Availability')
            ->paginate(10);
        return $this->success(data: $landsAvailable);
    }


    /**
     * @param Land $land
     * @param LandAvailable $landAvailable
     * @return ApiResponse
     */
    public function show(Land $land, LandAvailable $landAvailable): ApiResponse
    {
        if ($landAvailable->land_id !== $land->id) {
            return $this->error('Land Available not found for this Land', ['error_code' => 404]);
        }

        if ($landAvailable->land_state !== 'Availability') {
            return $this->error('Invalid land state', ['error_code' => 403]);
        }

        return $this->success(data: $landAvailable);
    }


    /**
     * @param StoreLandAvailableRequest $request
     * @param Land $land
     * @return ApiResponse
     */
    public function store(StoreLandAvailableRequest $request, Land $land): ApiResponse
    {
        $validatedData = $request->validated();

        $validatedData['land_id'] = $land->id;
        $validatedData['land_state'] = 'Availability';

        $landExists = Land::where('id', $land->id)->exists();
        if (!$landExists) {
            return $this->error('Invalid land_id: The land does not exist.', 422);
        }

        $landAvailable = LandAvailable::create($validatedData);

        return $this->success('Land Available created successfully', $landAvailable);
    }


    /**
     * @param UpdateLandAvailableRequest $request
     * @param Land $land
     * @param LandAvailable $landAvailable
     * @return ApiResponse
     */
    public function update(UpdateLandAvailableRequest $request, Land $land, LandAvailable $landAvailable): ApiResponse
    {
        try {
            if ($landAvailable->land_id !== $land->id) {
                return $this->error('The provided land does not match the available record.', 422);
            }

            $validatedData = $request->validated();

            $validatedData['land_id'] = $land->id;
            $validatedData['land_state'] = 'Availability';

            $landAvailable->update($validatedData);

            return $this->success('Land Available updated successfully', $landAvailable);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }


    /**
     * @param Land $land
     * @param LandAvailable $landAvailable
     * @return ApiResponse
     */
    public function destroy(Land $land, LandAvailable $landAvailable): ApiResponse
    {
        if ($landAvailable->land_id !== $land->id) {
            return $this->error('Land Available not found for this Land', ['error_code' => 404]);
        }

        if ($landAvailable->land_state !== 'Availability') {
            return $this->error('Invalid land state', ['error_code' => 403]);
        }

        try {
            if ($landAvailable->delete()) {
                return $this->success('Land Available deleted successfully', $landAvailable);
            }
            return $this->error('Land Available delete failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
