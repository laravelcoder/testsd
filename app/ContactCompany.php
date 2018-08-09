<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterByUser;

/**
 * Class ContactCompany
 *
 * @package App
 * @property string $name
 * @property string $website
 * @property string $email
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $country
 * @property string $logo
 * @property string $created_by
 * @property string $created_by_team
*/
class ContactCompany extends Model
{
    use FilterByUser;

    protected $fillable = ['name', 'website', 'email', 'address', 'address2', 'city', 'state', 'zipcode', 'country', 'logo', 'created_by_id', 'created_by_team_id'];
    protected $hidden = [];
    public static $searchable = [
        'name',
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByTeamIdAttribute($input)
    {
        $this->attributes['created_by_team_id'] = $input ? $input : null;
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function created_by_team()
    {
        return $this->belongsTo(Team::class, 'created_by_team_id');
    }
    
    public function contacts() {
        return $this->hasMany(Contact::class, 'company_id');
    }
    public function phones() {
        return $this->hasMany(Phone::class, 'advertiser_id');
    }
    public function campaigns() {
        return $this->hasMany(Campaign::class, 'advertiser_id');
    }
    public function ads() {
        return $this->hasMany(Ad::class, 'advertiser_id');
    }
}
