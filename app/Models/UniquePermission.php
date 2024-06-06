<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniquePermission extends Model
{
    use HasFactory;

    protected $table = 'uniquepermissions';

    protected $fillable = [
        'userId',
        'moduleId',
        'excelPermission',
        'fibrasPermission',
        'biChartsPermission',
        'status',
        'createdAt',
        'modifiedAt'
    ];

    public $timestamps = false;

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleId');
    }
}
