<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * 
 *
 * @property int $id
 * @property int $reit_id
 * @property int $year
 * @property string|null $quarter
 * @property string $noi
 * @property string $cap_rate
 * @property string $occupancy
 * @property int|null $m2
 * @property string $sqft
 * @property int $buildings
 * @property string $customer_retention_rate
 * @property string $average_rent
 * @property string $contracts
 * @property string $rental_income
 * @property string $dolar
 * @property string $prop_investment
 * @property string $type
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereAverageRent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereBuildings($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereCapRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereContracts($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereCustomerRetentionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereDolar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereM2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereNoi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereOccupancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual wherePropInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereQuarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereReitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereRentalIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereSqft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual withoutTrashed()
 * @property-read \App\Models\Reit $reit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual capRate($capRate)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual noi($noi)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual occupancy($occupancy)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual quarter($quarter)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual reitId($reitId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual reitName($reitName)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual sqft($sqft)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual type($type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitAnnual year($year)
 * @mixin \Eloquent
 */
class ReitAnnual extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'reit_annuals';

    protected $fillable = [
        'reit_id',
        'year',
        'quarter',
        'noi',
        'cap_rate',
        'occupancy',
        'm2',
        'sqft',
        'buildings',
        'customer_retention_rate',
        'average_rent',
        'contracts',
        'rental_income',
        'dolar',
        'prop_investment',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function reit()
    {
        return $this->belongsTo(Reit::class, 'reit_id');
    }

    public function scopeReitId($query, $reitId)
    {
        return $reitId ? $query->where('reit_id', $reitId) : $query;
    }

    public function scopeYear($query, $year)
    {
        return $year ? $query->where('year', $year) : $query;
    }

    public function scopeQuarter($query, $quarter)
    {
        return $quarter ? $query->where('quarter', $quarter) : $query;
    }

    public function scopeType($query, $type)
    {
        return $type ? $query->where('type', $type) : $query;
    }

    public function scopeNoi($query, $noi)
    {
        return $noi ? $query->where('noi', $noi) : $query;
    }

    public function scopeCapRate($query, $capRate)
    {
        return $capRate ? $query->where('cap_rate', $capRate) : $query;
    }

    public function scopeOccupancy($query, $occupancy)
    {
        return $occupancy ? $query->where('occupancy', $occupancy) : $query;
    }

    public function scopeSqft($query, $sqft)
    {
        return $sqft ? $query->where('sqft', $sqft) : $query;
    }

    public function scopeReitName($query, $reitName)
    {
        return $reitName
        ? $query->whereHas('reit', function ($query) use ($reitName) {
                $query->where('name', 'like', "%{$reitName}%");
            })
        : $query;
    }

    public static function filter(array $validated): mixed
    {
        $size = $validated['size'] ?? 10;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        return ReitAnnual::with(['reit'])
        ->leftJoin('cat_reits', 'cat_reits.id', '=', 'reit_annuals.reit_id')
        ->select('reit_annuals.*', 'cat_reits.name AS reitName')
        ->reitId(request('reit_id'))
        ->reitName(request('reitName'))
        ->year(request('year'))
        ->quarter(request('quarter'))
        ->type(request('type'))

        ->noi(request('noi'))
        ->capRate(request('cap_rate'))
        ->occupancy(request('occupancy'))
        ->sqft(request('sqft'))

        ->orderBy($order, $direction)
        ->paginate($size);
    }
}
