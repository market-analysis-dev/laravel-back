<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFiberRequest;
use App\Http\Requests\UpdateFiberRequest;
use App\Models\Fiber;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class FiberController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $fibers = Fiber::all();
        return $this->success(data: $fibers);
    }

    /**
     * @param StoreFiberRequest $request
     * @return ApiResponse
     */
    public function store(StoreFiberRequest $request): ApiResponse
    {
        $fiber = Fiber::create($request->validated());
        return $this->success('Fiber created successfully', $fiber);
    }

    /**
     * @param UpdateFiberRequest $request
     * @param Fiber $fiber
     * @return ApiResponse
     */
    public function update(UpdateFiberRequest $request, Fiber $fiber): ApiResponse
    {
        try{
            if($fiber->update($request->validated())) {
                return $this->success('Fiber updated successfully', $fiber);
            }
            return  $this->error('Fiber updated field', status: 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status: 500);
        }
    }

    /**
     * @param Fiber $fiber
     * @return ApiResponse
     */
    public function destroy(Fiber $fiber): ApiResponse
    {
        try{
            if($fiber->delete()) {
                return $this->success('Fiber deleted successfully', $fiber);
            }
            return $this->error('Fiber deleted filed', status: 423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status: 500);
        }
    }
}
