<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebsiteShareOnCategory extends Model
{
    use SoftDeletes;
    protected $primaryKey='wsoc_id';
    protected $dates = ['deleted_at'];
    protected $table = 'website_share_on_categories';

    /**
     * WebsiteShareOnCategory belongs to Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
    	// belongsTo(RelatedModel, foreignKey = cate_id, keyOnRelatedModel = cate_id)
    	return $this->belongsTo('App\Category','cate_id','cate_id');
    }
}
