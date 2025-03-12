<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $comments
 * @property int $is_direct_contact
 * @property int $is_land_contact
 * @property int $is_buildings_contact
 * @property int $is_broker_contact
 * @property int $is_developer_contact
 * @property int $is_owner_contact
 * @property int $is_company_contact
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereContactComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsBrokerContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsBuildingsContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsCompanyContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsDeveloperContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsDirectContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsLandContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsOwnerContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact withoutTrashed()
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string|null $comments
 * @property int $has_building
 * @property int $has_land
 * @property int $has_broker
 * @property int $has_company
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereHasBroker($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereHasBuilding($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereHasCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereHasLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact wherePhone($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'comments',
        'is_direct_contact',
        'is_land_contact',
        'is_buildings_contact',
        'is_broker_contact',
        'is_developer_contact',
        'is_owner_contact',
        'is_company_contact',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function buildings(): BelongsToMany
    {
        return $this->belongsToMany(Building::class, 'building_contacts', 'contact_id', 'building_id');
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_contacts', 'contact_id', 'company_id');
    }

    public function lands(): BelongsToMany
    {
        return $this->belongsToMany(Land::class, 'land_contacts', 'contact_id', 'land_id');
    }

    public function scopeName($query, $name)
    {
        return $name ? $query->where('name', $name) : $query;
    }

    public function scopePhone($query, $phone)
    {
        return $phone ? $query->where('phone', $phone) : $query;
    }

    public function scopeEmail($query, $email)
    {
        return $email ? $query->where('email', $email) : $query;
    }

    public function scopeSearch($query, $search)
    {
        return ($search
            ? $query->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('comments', 'like', "%{$search}%")
            : $query
        );
    }

    public function scopeComments($query, $comments)
    {
        return $comments ? $query->where('comments', $comments) : $query;
    }

    public function scopeIsBoolPropContact($query, $boolProp, $value)
    {
        if (!in_array($boolProp, ['is_direct_contact', 'is_land_contact', 'is_buildings_contact', 'is_broker_contact', 'is_developer_contact', 'is_owner_contact', 'is_company_contact'])) return $query;
        return is_bool($value) ? $query->where($boolProp, $value) : $query;
    }

    public function scopeNotBuilding($query, $building_id)
    {
        return $building_id ? $query->whereDoesntHave('buildings', function ($query) use ($building_id) {
            $query->where('buildings.id', $building_id);
        }) : $query;
    }

    public function scopeNotLand($query, $land_id)
    {
        return $land_id ? $query->whereDoesntHave('lands', function ($query) use ($land_id) {
            $query->where('lands.id', $land_id);
        }) : $query;
    }

    public function scopeNotCompany($query, $company_id)
    {
        return $company_id ? $query->whereDoesntHave('companies', function ($query) use ($company_id) {
            $query->where('companies.id', $company_id);
        }) : $query;
    }

    public function scopeFilter($query, array $dataValidated)
    {
        foreach ($dataValidated as $key => $value) {
            if (in_array($key, ['is_direct_contact', 'is_land_contact', 'is_buildings_contact', 'is_broker_contact', 'is_developer_contact', 'is_owner_contact', 'is_company_contact'])) {
                $query->isBoolPropContact($key, filter_var($value, FILTER_VALIDATE_BOOLEAN));
            } elseif (in_array($key, ['name', 'phone', 'email', 'comments'])) {
                $query->{$key}($value ?? null);
            }
        }
        $query->search($dataValidated['search'] ?? null);
        $query->notBuilding($dataValidated['not_building_id'] ?? null);
        $query->notLand($dataValidated['not_land_id'] ?? null);
        $query->notCompany($dataValidated['not_company_id'] ?? null);
        return $query;
    }
}
