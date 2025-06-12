<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantsByParkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tenant' => $this->tenant->name,
            'size_sf' => $this->size_sf,
            'industrial_park' => $this->building->industrialPark->name,
            'owner' => $this->building->owner->name,
            'developer' => $this->building->developer->name,
            'market' => $this->building->market->name,
            'submarket' => $this->building->subMarket->name,
            'industry' => $this->industry->name,
            'abs_final_use' => $this->abs_final_use,
            'country' => $this->country->name,
            'tenancy' => $this->building->tenancy,
            'latitude' => $this->building->latitud,
            'longitude' => $this->building->longitud,


        ];
    }
}
