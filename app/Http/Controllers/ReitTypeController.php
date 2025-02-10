<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use App\Models\ReitType;
use App\Http\Requests\StoreReitTypeRequest;
use App\Http\Requests\UpdateReitTypeRequest;

class ReitTypeController extends ApiController
{
    public function index(): ApiResponse
    {
        $reitTypes = ReitType::all();
        return $this->success(data: $reitTypes);
    }

    public function store(StoreReitTypeRequest $request): ApiResponse
    {
        $reitType = ReitType::create($request->validated());
        return $this->success('Reit type created successfully', $reitType);
    }

    public function show(ReitType $reitType): ApiResponse
    {
        return $this->success(data: $reitType);
    }

    public function update(UpdateReitTypeRequest $request, ReitType $reitType): ApiResponse
    {
        try{
            if($reitType->update($request->validated())) {
                return $this->success('Reit type updated successfully', $reitType);
            }
            return  $this->error('Reit type updated field', status: 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status: 500);
        }
    }

    public function destroy(ReitType $reitType): ApiResponse
    {
        try{
            if($reitType->delete()) {
                return $this->success('Reit type deleted successfully', $reitType);
            }
            return $this->error('Reit type deleted filed', status: 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status: 500);
        }
    }
}
