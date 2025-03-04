<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
