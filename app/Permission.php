<?php

namespace App;

class Permission extends \Spatie\Permission\Models\Permission
{
    public function group()
    {
        return $this->belongsTo('App\PermissionGroup', 'group_id', 'id');
    }
}
