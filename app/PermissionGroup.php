<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PermissionGroup extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function permissions()
    {
        return $this->hasMany('App\Permission', 'group_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo('App\PermissionGroup', 'parent_id', 'id');
    }

    public function childs(): HasMany
    {
        return $this->hasMany('App\PermissionGroup', 'parent_id', 'id');
    }
}
