<?php
namespace App\Enums;

enum Roles: string
{
    case ADMIN = 'Admin';
    case WEB_USER = 'Web User';
    case MARKETING_EDITOR = 'Marketing Editor';
    case FIBRA_EDITOR = 'Fibra Editor';
    case FIELD_WORKER = 'Field worker';
}