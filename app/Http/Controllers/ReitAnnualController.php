<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReitAnnualRequest;
use App\Http\Requests\UpdateReitAnnualRequest;
use App\Models\ReitAnnual;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class ReitAnnualController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $reitsAnnual = ReitAnnual::all();
        return $this->success(data: $reitsAnnual);
    }

    /**
     * @param StoreReitAnnualRequest $request
     * @return ApiResponse
     */
    public function store(StoreReitAnnualRequest $request): ApiResponse
    {
        $reitAnnual = ReitAnnual::create($request->validated());
        return $this->success('Reit annual created successfully', $reitAnnual);
    }

    /**
     * @param ReitAnnual $reitAnnual
     * @return ApiResponse
     */
    public function show(ReitAnnual $reitAnnual): ApiResponse
    {
        return $this->success(data: $reitAnnual);
    }

    /**
     * @param UpdateReitAnnualRequest $request
     * @param ReitAnnual $reitAnnual
     * @return ApiResponse
     */
    public function update(UpdateReitAnnualRequest $request, ReitAnnual $reitAnnual): ApiResponse
    {
        try {
            if($reitAnnual->update($request->validated())) {
                return $this->success('Reit annual updated successfully', $reitAnnual);
            }
            return  $this->error('Reit annual updated field', status: 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status: 500);
        }
    }

    /**
     * @param ReitAnnual $reitAnnual
     * @return ApiResponse
     */
    public function destroy(ReitAnnual $reitAnnual): ApiResponse
    {
        try{
            if($reitAnnual->delete()) {
                return $this->success('Reit annual deleted successfully', $reitAnnual);
            }
            return $this->error('Reit annual deleted filed', status: 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status: 500);
        }
    }
}
