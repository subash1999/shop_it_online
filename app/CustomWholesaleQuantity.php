<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomWholesaleQuantity extends Model
{
    use SoftDeletes;
    protected $primaryKey='cwq_id';
    protected $dates = ['deleted_at'];
    protected $table = 'custom_wholesale_quantities';

    /**
     * CustomWholesaleQty belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProducts','sp_id','sp_id');
    }
}
