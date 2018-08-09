<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @package App
 * @property string $category
 * @property string $slug
*/
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['category', 'slug'];
    protected $hidden = [];
    public static $searchable = [
        'category',
        'slug',
    ];
    
    
    public function advertiser_id()
    {
        return $this->belongsToMany(ContactCompany::class, 'category_contact_company');
    }
    
    public function ad_id()
    {
        return $this->belongsToMany(Ad::class, 'ad_category')->withTrashed();
    }
    
}
