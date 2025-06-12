<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientBuildingAvailabilityStatisticResource extends JsonResource
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
            'total_buildings' => $this->convertSize($this['total_buildings'], $convert),
            'total_buildings_count' => $this['total_buildings_count'],
            'total_class_a' => $this->convertSize($this['total_class_a'], $convert),
            'total_class_a_count' => $this['total_class_a_count'],
            'total_percent_a' => $this['total_percent_a'],
            'total_class_b' => $this->convertSize($this['total_class_b'], $convert),
            'total_class_b_count' => $this['total_class_b_count'],
            'total_percent_b' => $this['total_percent_b'],
            'total_class_c' => $this->convertSize($this['total_class_c'], $convert),
            'total_class_c_count' => $this['total_class_c_count'],
            'total_percent_c' => $this['total_percent_c'],
            'total_underconstruction' => $this->convertSize($this['total_underconstruction'], $convert),
            'total_underconstruction_count' => $this['total_underconstruction_count'],
            'total_percent_underconstruction' => $this['total_percent_underconstruction'],
            'total_by_locations' => collect($this['total_by_locations'])->map(function ($location) use ($convert) {
                return [
                    'region_id' => $location['state_id'],
                    'region_name' => $location['state_name'],
                    'total' => $this->convertSize($location['total'], $convert),
                    'percent' => $location['percent'],
                ];
            }),
        ];
    }

    protected function convertSize($value, $convert)
    {
        return $convert ? round($value * 10.7639, 2) : $value; // m² → sqft
    }
}
