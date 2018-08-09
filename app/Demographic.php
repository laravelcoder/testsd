<?php

namespace App;

use App\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Demographic.
 *
 * @property string $demographic
 * @property string $value
 * @property string $created_by
 * @property string $created_by_team
 * @property string $advertiser
 */
class Demographic extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['demographic', 'value', 'created_by_id', 'created_by_team_id', 'advertiser_id'];
    protected $hidden = [];
    public static $searchable = [
        'demographic',
    ];

    /**
     * Set to null if empty.
     *
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty.
     *
     * @param $input
     */
    public function setCreatedByTeamIdAttribute($input)
    {
        $this->attributes['created_by_team_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty.
     *
     * @param $input
     */
    public function setAdvertiserIdAttribute($input)
    {
        $this->attributes['advertiser_id'] = $input ? $input : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function created_by_team()
    {
        return $this->belongsTo(Team::class, 'created_by_team_id');
    }

    public function advertiser()
    {
        return $this->belongsTo(ContactCompany::class, 'advertiser_id');
    }
}
