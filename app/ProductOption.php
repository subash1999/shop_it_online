<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use SoftDeletes;
    protected $primaryKey='product_opt_id';
    protected $dates = ['deleted_at'];
    protected $table = 'product_options';

    /**
     * ProductOption belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('SellerProduct','sp_id','sp_id');
    }

    /**
     * ProductOption belongs to Option.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option()
    {
    	// belongsTo(RelatedModel, foreignKey = option_id, keyOnRelatedModel = option_id)
    	return $this->belongsTo('App\Option','option_id','option_id');
    }

    /**
     * ProductOption belongs to OptionGroup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function optionGroup()
    {
    	// belongsTo(RelatedModel, foreignKey = option_g__id, keyOnRelatedModel = option_g_id)
    	return $this->belongsTo('App\OptionGroup','option_g_id','option_g_id');
    }

    
   
}
