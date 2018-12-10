<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $primaryKey='cate_id';
    protected $dates = ['deleted_at'];
    protected $table = 'categories';


    /**
     * Category has one WebsiteShareOnCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function websiteShareOnCategory()
    {
    	// hasOne(RelatedModel, foreignKeyOnRelatedModel = cate_id, localKey = cate_id)
    	return $this->hasOne('App\WebsiteShareOnCategory','cate_id','cate_id');
    }

    /**
     * Category has many CategoryProductRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryProductRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = cate_id, localKey = cate_id)
        return $this->hasMany('App\CategoryProductRelation','cate_id','cate_id');
    }
}
