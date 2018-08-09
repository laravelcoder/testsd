<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Station.
 *
 * @property string $station_label
 * @property string $channel_number
 * @property string $affiliate
 * @property string $network
 */
class Station extends Model
{
    use SoftDeletes;

    protected $fillable = ['station_label', 'channel_number', 'affiliate_id', 'network_id'];
    protected $hidden = [];
    public static $searchable = [
        'station_label',
        'channel_number',
    ];

    /**
     * Set to null if empty.
     *
     * @param $input
     */
    public function setAffiliateIdAttribute($input)
    {
        $this->attributes['affiliate_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty.
     *
     * @param $input
     */
    public function setNetworkIdAttribute($input)
    {
        $this->attributes['network_id'] = $input ? $input : null;
    }

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class, 'affiliate_id')->withTrashed();
    }

    public function network()
    {
        return $this->belongsTo(Network::class, 'network_id')->withTrashed();
    }
}
