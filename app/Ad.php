<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Ad
 *
 * @package App
 * @property string $ad_label
 * @property text $ad_description
 * @property string $video_upload
 * @property integer $total_impressions
 * @property integer $total_networks
 * @property integer $total_channels
 * @property string $advertiser
 * @property string $created_by
 * @property string $created_by_team
 * @property string $video_screenshot
*/
class Ad extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['ad_label', 'ad_description', 'video_upload', 'total_impressions', 'total_networks', 'total_channels', 'video_screenshot', 'advertiser_id', 'created_by_id', 'created_by_team_id'];
    protected $hidden = [];
    public static $searchable = [
        'ad_label',
    ];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalImpressionsAttribute($input)
    {
        $this->attributes['total_impressions'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalNetworksAttribute($input)
    {
        $this->attributes['total_networks'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalChannelsAttribute($input)
    {
        $this->attributes['total_channels'] = $input ? $input : null;
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
    
    public function advertiser()
    {
        return $this->belongsTo(ContactCompany::class, 'advertiser_id');
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function created_by_team()
    {
        return $this->belongsTo(Team::class, 'created_by_team_id');
    }
    
    public function category_id()
    {
        return $this->belongsToMany(Category::class, 'ad_category')->withTrashed();
    }
    
}
