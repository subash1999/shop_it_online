<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;

class AutoProductDivision extends Model
{
    use SoftDeletes;
    protected $primaryKey='apd_id';
    protected $dates = ['deleted_at'];
    protected $table = 'auto_product_divisions';

    /**
     * AutoProductDivision belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }
}
