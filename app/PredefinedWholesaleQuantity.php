<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PredefinedWholesaleQuantity extends Model
{
    use SoftDeletes;
    protected $primaryKey='pwq_id';
    protected $dates = ['deleted_at'];
    protected $table = 'predefined_wholesale_quantities';

    /**
     * PredefinedWholesaleQty belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProducts','sp_id','sp_id');
    }
}
