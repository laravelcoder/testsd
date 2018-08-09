<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role.
 *
 * @property string $title
 */
class Role extends Model
{
    protected $fillable = ['title'];
    protected $hidden = [];
    public static $searchable = [
    ];

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
