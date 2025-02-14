<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use App\Models\Broker;
use App\Http\Requests\StoreBrokerRequest;
use App\Http\Requests\UpdateBrokerRequest;

class BrokerController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $brokers = Broker::all();
        return $this->success(data: $brokers);
    }

    /**
     * @param StoreBrokerRequest $request
     * @return ApiResponse
     */
    public function store(StoreBrokerRequest $request): ApiResponse
    {
        $broker = Broker::create($request->validated());
        return $this->success('Broker created successfully', $broker);
    }

    /**
     * @param Broker $broker
     * @return ApiResponse
     */
    public function show(Broker $broker): ApiResponse
    {
        return $this->success(data: $broker);
    }

    /**
     * @param UpdateBrokerRequest $request
     * @param Broker $broker
     * @return ApiResponse
     */
    public function update(UpdateBrokerRequest $request, Broker $broker): ApiResponse
    {
        try {
            if ($broker->update($request->validated())) {
                return $this->success('Broker updated successfully', $broker);
            }

            return $this->error('Broker update failed', status:423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }

    /**
     * @param Broker $broker
     * @return ApiResponse
     */
    public function destroy(Broker $broker): ApiResponse
    {
        try {
            if ($broker->delete()) {
                return $this->success('Broker deleted successfully', $broker);
            }
            return $this->error('Broker delete failed', status:423);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), status:500);
        }
    }

}
