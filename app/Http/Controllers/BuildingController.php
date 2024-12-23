<?php

namespace App\Http\Controllers;

use App\Enums\BuildingClass;
use App\Enums\BuildingLoadingDoor;
use App\Responses\ApiResponse;

class BuildingController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function listClasses(): ApiResponse
    {

        return $this->success(data: BuildingClass::array());
    }

    public function listLoadingDoor(): ApiResponse
    {
        return $this->success(data: BuildingLoadingDoor::array());
    }
}
