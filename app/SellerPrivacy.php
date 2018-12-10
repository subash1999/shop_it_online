<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerPrivacy extends Model
{
    use SoftDeletes;
    protected $primaryKey='s_pri_id';
    protected $dates = ['deleted_at'];
    protected $table = 'seller_privacies';

    /**
     * SellerPrivacy belongs to Seller.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
    	// belongsTo(RelatedModel, foreignKey = seller_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\Seller','seller_id','seller_id');
    }
    
}
