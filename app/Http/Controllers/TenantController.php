<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use App\Models\Tenant;

class TenantController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $tenants = Tenant::all();
        return $this->success(data: $tenants);
    }


    /**
     * @param StoreTenantRequest $request
     * @return ApiResponse
     */
    public function store(StoreTenantRequest $request): ApiResponse
    {
        $tenant = Tenant::create($request->validated());
        return $this->success('Tenant created successfully', $tenant);
    }

    /**
     * @param UpdateTenantRequest $request
     * @param Tenant $tenant
     * @return ApiResponse
     */
    public function update(UpdateTenantRequest $request, Tenant $tenant): ApiResponse
    {
        try {
            if ($tenant->update($request->validated())) {
                return $this->success('Tenant updated successfully', $tenant);
            }

            return $this->error('Tenant update failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }


    /**
     * @param Tenant $tenant
     * @return ApiResponse
     */
    public function destroy(Tenant $tenant): ApiResponse
    {
        try {
            if ($tenant->delete()) {
                return $this->success('Tenant deleted successfully', $tenant);
            }
            return $this->error('Tenant delete failed', 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

}
