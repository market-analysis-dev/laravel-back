<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 *
 *
 * @property int $id
 * @property int $reit_id
 * @property int $reit_type_id
 * @property int $year
 * @property string $quarter
 * @property string $net_income
 * @property string $return_on_enquity
 * @property string $return_on_assets
 * @property string $return_on_invested_capital
 * @property string $interest_income
 * @property string $number_loans
 * @property string $outstanding_portfolio
 * @property string $overdue_portfolio
 * @property string $avg_interest_rate_fovisste
 * @property string $avg_interest_rate_pdh
 * @property string $dollar
 * @property string $divided_yield
 * @property string $total_portfolio
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Reit $reit
 * @property-read \App\Models\ReitType $reitType
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereAvgInterestRateFovisste($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereAvgInterestRatePdh($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereDividendYield($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereDollar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereInterestIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereNetIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereNumberLoans($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereOutstandingPortfolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereOverduePortfolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereQuarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereReitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereReitTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereReturnOnAssets($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereReturnOnEquity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereReturnOnInvestedCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereTotalPortfolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitMortgage withoutTrashed()
 * @mixin \Eloquent
 */
class ReitMortgage extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'reit_mortgages';

    protected $fillable = [
        'reit_id',
        'reit_type_id',
        'year',
        'quarter',
        'net_income',
        'return_on_enquity',
        'return_on_assets',
        'return_on_invested_capital',
        'interest_income',
        'number_loans',
        'outstanding_portfolio',
        'overdue_portfolio',
        'avg_interest_rate_fovisste',
        'avg_interest_rate_pdh',
        'dollar',
        'divided_yield',
        'total_portfolio',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function reit(): BelongsTo
    {
        return $this->belongsTo(Reit::class, 'reit_id');
    }

    public function reitType(): BelongsTo
    {
        return $this->belongsTo(ReitType::class, 'reit_type_id');
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

    public function scopeReitName($query, $reitName)
    {
        return $reitName
        ? $query->whereHas('reit', function ($query) use ($reitName) {
                $query->where('name', 'like', "%{$reitName}%");
            })
        : $query;
    }

    public function scopeReitTypeName($query, $reitTypeName)
    {
        return $reitTypeName
        ? $query->whereHas('reitType', function ($query) use ($reitTypeName) {
                $query->where('name', 'like', "%{$reitTypeName}%");
            })
        : $query;
    }

    public static function filter(array $validated): mixed
    {
        $size = $validated['size'] ?? 10;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        return self::with(['reit', 'reitType'])
        ->leftJoin('cat_reits', 'cat_reits.id', '=', 'reit_mortgages.reit_id')
        ->leftJoin('cat_reit_types', 'cat_reit_types.id', '=', 'reit_mortgages.reit_type_id')
        ->select('reit_mortgages.*', 'cat_reits.name AS reitName', 'cat_reit_types.name AS reitTypeName')
        ->reitId(request('reit_id'))
        ->reitName(request('reitName'))
        ->year(request('year'))
        ->quarter(request('quarter'))
        ->reitTypeName(request('reitTypeName'))

        ->orderBy($order, $direction)
        ->paginate($size);
    }

}
