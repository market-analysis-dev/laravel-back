<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class ShelterController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $shelters = Shelter::all();
        return $this->success(data: $shelters);
    }

}
