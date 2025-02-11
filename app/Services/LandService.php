<?php


namespace App\Services;


use App\Models\Land;

class LandService
{
    /**
     * @param array $validated
     * @return mixed
     */
    public function filter(array $validated): mixed
    {
        $size = $validated['size'] ?? 10;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        return Land::with(['market', 'subMarket', 'industrialPark', 'region', 'owner', 'developer', 'contact'])
            ->when($validated['search'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search){
                    $query->where('status', 'like', "%{$search}%")
                        ->orWhere('land_name', 'like', "%{$search}%");
                });
            })
            ->when($validated['status'] ?? false, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($validated['land_name'] ??  false, function ($query, $land_name){
                $query->where('land_name', 'like', "%{$land_name}%");
            })
            ->when($validated['marketName'] ?? false, function ($query, $marketName) {
                $query->whereHas('market', function ($query) use ($marketName) {
                    $query->where('name', 'like', "%{$marketName}%");
                });
            })
            ->when($validated['submarketName'] ?? false, function ($query, $submarketName){
                $query->whereHas('subMarket', function ($query) use ($submarketName) {
                    $query->where('name', 'like', "%{$submarketName}%");
                });
            })
            ->when($validated['industrialParkName'] ?? false, function ($query, $industrialParkName) {
                $query->whereHas('industrialPark', function ($query) use ($industrialParkName) {
                    $query->where('name', 'like', "%{$industrialParkName}%");
                });
            })
            ->orderBy($order, $direction)
            ->paginate($size);
    }

    /**
     * @param Land $land
     * @return Land
     */
    public function show(Land $land): Land
    {
        return $land->load([
            'region',
            'market',
            'subMarket',
            'industrialPark',
            'developer',
            'owner',
            'contact',
        ]);
    }
}
