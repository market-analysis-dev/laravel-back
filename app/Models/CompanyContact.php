<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int $company_id
 * @property int $contact_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Contact $contact
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyContact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyContact whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyContact whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyContact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyContact extends Model
{
    use HasFactory;

    protected $table = 'company_contacts';

    protected $fillable = [
        'company_id',
        'contact_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
