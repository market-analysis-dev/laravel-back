<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use App\Models\Country;

class CountryController extends ApiController
{
    /**
     * @return ApiResponse
     */
    public function index(): ApiResponse
    {
        $countries = Country::all();
        return $this->success(data: $countries);
    }
}
