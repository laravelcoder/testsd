<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterByUser;

/**
 * Class Contact
 *
 * @package App
 * @property string $company
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $skype
 * @property string $address
 * @property text $notes
 * @property string $created_by
 * @property string $created_by_team
*/
class Contact extends Model
{
    use FilterByUser;

    protected $fillable = ['first_name', 'last_name', 'email', 'skype', 'address', 'notes', 'company_id', 'created_by_id', 'created_by_team_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCompanyIdAttribute($input)
    {
        $this->attributes['company_id'] = $input ? $input : null;
    }

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
    
    public function company()
    {
        return $this->belongsTo(ContactCompany::class, 'company_id');
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function created_by_team()
    {
        return $this->belongsTo(Team::class, 'created_by_team_id');
    }
    
    public function phones() {
        return $this->hasMany(Phone::class, 'contact_id');
    }
}
