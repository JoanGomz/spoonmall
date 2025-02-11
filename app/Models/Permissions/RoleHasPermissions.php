<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermissions extends Model
{
    protected $table = 'role_has_permissions';

    protected $primaryKey = 'permission_id|role_id';

    protected $fillable = [
        'permission_id',
        'role_id',
        'status',
        'can_update',
        'can_write',
        'can_read'
    ];
}
