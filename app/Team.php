<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Team.
 *
 * @property string $name
 */
class Team extends Model
{
    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
}
