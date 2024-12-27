<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Models\Owner;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class OwnerController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $owners = Owner::all();
        return $this->success(data: $owners);
    }

    /**
     * @param StoreOwnerRequest $request
     * @return ApiResponse
     */
    public function store(StoreOwnerRequest $request): ApiResponse
    {
        $owner = Owner::create($request->validated());
        return $this->success('Owner created successfully', $owner);
    }

    /**
     * @param UpdateOwnerRequest $request
     * @param $owner
     * @return ApiResponse
     */
    public function update(UpdateOwnerRequest $request, Owner $owner): ApiResponse
    {
        try {
            if ($owner->update($request->validated())) {
                return $this->success('Owner updated successfully', $owner);
            }

            return $this->error('Owner update failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

    }

    /**
     * @param Owner $owner
     * @return ApiResponse
     */
    public function destroy(Owner $owner): ApiResponse
    {
        try {
            if ($owner->delete()) {
                return $this->success('Owner deleted successfully', $owner);
            }
            return $this->error('Owner delete failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

    }
}
