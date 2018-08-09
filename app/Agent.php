<?php

namespace App;

use App\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Agent.
 *
 * @property string $advertiser_company
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $skype
 * @property string $address
 * @property string $photo
 * @property text $about
 * @property string $created_by
 * @property string $created_by_team
 * @property text $notes
 * @property string $advertiser
 */
class Agent extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['advertiser_company', 'first_name', 'last_name', 'email', 'skype', 'address', 'photo', 'about', 'notes', 'created_by_id', 'created_by_team_id', 'advertiser_id'];
    protected $hidden = [];
    public static $searchable = [
        'advertiser_company',
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

    public function phones()
    {
        return $this->hasMany(Phone::class, 'agent_id');
    }
}
