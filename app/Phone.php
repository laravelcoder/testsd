<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Phone
 *
 * @package App
 * @property string $phone_number
 * @property string $contact
 * @property string $advertiser
 * @property string $agent
*/
class Phone extends Model
{
    use SoftDeletes;

    protected $fillable = ['phone_number', 'contact_id', 'advertiser_id', 'agent_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setContactIdAttribute($input)
    {
        $this->attributes['contact_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAdvertiserIdAttribute($input)
    {
        $this->attributes['advertiser_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAgentIdAttribute($input)
    {
        $this->attributes['agent_id'] = $input ? $input : null;
    }
    
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
    
    public function advertiser()
    {
        return $this->belongsTo(ContactCompany::class, 'advertiser_id');
    }
    
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id')->withTrashed();
    }
    
}
