<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $primaryKey='p_id';
    protected $dates = ['deleted_at'];
    protected $table = 'products';

    /**
     * Product has many SellerProducts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerProducts()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = product_id, localKey = id)
    	return $this->hasMany('App\SellerProduct','sp_id','sp_id');
    }

    /**
     * Product has many CategoryProductRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryProductRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = p_id, localKey = p_id)
        return $this->hasMany('App\CategoryProductRelation','p_id','p_id');
    }

    
  
}
