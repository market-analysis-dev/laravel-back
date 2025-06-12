<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientBuildingAvailabilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $convert = filter_var($request->input('sqftToM2'), FILTER_VALIDATE_BOOLEAN);

        return [
            'class' => $this->class,
            'building_name' => $this->building_name,
            'building_size' => $this->convertSize($this->size_sf, $convert),
            'available_size' => $this->convertSize($this->size_sf, $convert),
            'minimum_space' => $this->convertSize($this->avl_minimum_space_sf, $convert),
            'expansion_up_to' => $this->convertSize($this->avl_expansion_up_to_sf, $convert),
            'industrial_park' => $this->industrial_park_name,
            'clear_height' => $this->convertHeight($this->clear_height_ft, $convert),
            'dock_doors' => $this->dock_doors,
            'drive_in_door' => $this->drive_in_door,
            'floor_thickness' => $this->convertInToCm($this->floor_thickness),
            'type' => $this->avl_type,
            'owner' => $this->owner_name,
            'developer' => $this->developer_name,
            'builder' => $this->builder_name,
            'generation' => $this->generation,
            'market' => $this->market_name,
            'submarket' => $this->sub_market_name,
            'deal' => $this->deal,
            'currency' => $this->currency,
            'min_lease' => $this->min_lease,
            'max_lease' => $this->max_lease,
            'sale_price' => $this->sale_price,
            'available_since' => $this->formatQuarter($this->avl_date),
            'tenancy' => $this->tenancy,
            'broker' => $this->broker_name,
            'comments' => $this->comments,
        ];
    }

    protected function convertSize($value, $convert)
    {
        return $convert ? round($value * 0.092903, 2) : $value; // sqft → m2
    }

    protected function convertHeight($value, $convert)
    {
        return $convert ? round($value * 0.3048, 2) : $value; // ft → m
    }

    protected function convertInToCm($value)
    {
        return $value ? round($value * 2.54, 2) : $value; // in → cm
    }

    protected function formatQuarter($date)
    {
        if (!$date) return null;

        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));
        $quarter = ceil($month / 3);

        return 'Q' . $quarter . ' ' . $year;
    }
}
