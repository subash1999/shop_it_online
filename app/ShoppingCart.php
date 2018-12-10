<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCart extends Model
{
    use SoftDeletes;
    protected $primaryKey='sc_id';
    protected $dates = ['deleted_at'];
    protected $table = 'shopping_carts';

    /**
     * ShoppingCart belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','user_id','user_id');
    }

    /**
     * ShoppingCart belongs to SPSubDivision.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SPSubDivision()
    {
    	// belongsTo(RelatedModel, foreignKey = spsd_id, keyOnRelatedModel = spsd_id)
    	return $this->belongsTo('App\SPSubDivision','spsd_id','spsd_id');
    }

    /**
     * ShoppingCart belongs to SPOptionRelation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SPOptionRelation()
    {
        // belongsTo(RelatedModel, foreignKey = sPOptionRelation_id, keyOnRelatedModel = id)
        return $this->belongsTo("App\SPOptionRelation",'spor_id','spor_id');
    }

    /**
     * ShoppingCart belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }
}
