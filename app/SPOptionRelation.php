<?php

namespace App;

use App\Http\Helpers\WishlistHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SPOptionRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='spor_id';
    protected $dates = ['deleted_at'];
    protected $table = 's_p_option_relations';

    /**
     * SPOptionRelation belongs to Option.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option()
    {
    	// belongsTo(RelatedModel, foreignKey = option_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Option::class,'option_id','option_id');
    }

    /**
     * SPOptionRelation has many ShoppingCart.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shoppingCart()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sPOptionRelation_id, localKey = id)
        return $this->hasMany('App\ShoppingCart','spor_id','spor_id');
    }

    /**
     * SPOptionRelation has many Wishlist.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlist()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sPOptionRelation_id, localKey = id)
        return $this->hasMany('App\Wishlist','spor_id','spor_id');
    }

    public function transistionHistory()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sPOptionRelation_id, localKey = id)
        return $this->hasMany('App\TransistionHistory','spor_id','spor_id');
    }
    /**
     * SPOptionRelation belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = id)
    	return $this->belongsTo(SellerProduct::class,'sp_id','sp_id');
    }

    /**
     * SPOptionRelation belongs to Option.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_option()
    {
    	// belongsTo(RelatedModel, foreignKey = option_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Option::class,'parent_option_id','option_id');
    }

    // finding if this given SPOPtionRelation is in the wishlist
    public function isInWishlist()
    {
        $wishlist_helper = new WishlistHelper;
        return $wishlist_helper->isSPOPtionRelationInWishlist($this->spor_id);
    }
}
