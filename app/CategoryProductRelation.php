<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProductRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='cate_pr_id';
    protected $dates = ['deleted_at'];
    protected $table = 'category_product_relations';

    /**
     * CategoryProductRelation belongs to Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
    	// belongsTo(RelatedModel, foreignKey = cate_id, keyOnRelatedModel = cate_id)
    	return $this->belongsTo('App\Category','cate_id','cate_id');
    }

    /**
     * CategoryProductRelation belongs to Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
    	// belongsTo(RelatedModel, foreignKey = p_id, keyOnRelatedModel = p_id)
    	return $this->belongsTo('App\Product','p_id','p_id');
    }
}
