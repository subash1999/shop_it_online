<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SPPaymentRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='sppr_id';
    protected $dates = ['deleted_at'];
    protected $table = 's_p_payment_relations';

    /**
     * SPPaymentRelation belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }

    /**
     * SPPaymentRelation belongs to PaymentMethod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
    	// belongsTo(RelatedModel, foreignKey = pay_m_id, keyOnRelatedModel = pay_m_id)
    	return $this->belongsTo('App\PaymentMethod','pay_m_id','pay_m_id');
    }
}
