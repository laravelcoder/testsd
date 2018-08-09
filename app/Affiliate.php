<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Affiliate.
 *
 * @property string $affiliate
 */
class Affiliate extends Model
{
    use SoftDeletes;

    protected $fillable = ['affiliate'];
    protected $hidden = [];
    public static $searchable = [
    ];

    public function stations()
    {
        return $this->hasMany(Station::class, 'affiliate_id');
    }
}
