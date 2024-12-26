<?php

namespace App\Http\Controllers;

use App\Enums\BuildingClass;
use App\Enums\BuildingLoadingDoor;
use App\Enums\BuildingPhase;
use App\Enums\BuildingTenancy;
use App\Enums\BuildingTypeConstruction;
use App\Enums\BuildingTypeGeneration;
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

    public function listPhases(): ApiResponse
    {
        return $this->success(data: BuildingPhase::array());
    }

    public function listTypeGenerations(): ApiResponse
    {
        return $this->success(data: BuildingTypeGeneration::array());
    }

    public function listTenancies(): ApiResponse
    {
        return $this->success(data: BuildingTenancy::array());
    }

    public function listTypeConstruction(): ApiResponse
    {
        return $this->success(data: BuildingTypeConstruction::array());
    }
}
