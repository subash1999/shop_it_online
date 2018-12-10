<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerPayment extends Model
{
    use SoftDeletes;
    protected $primaryKey='seller_pay_id';
    protected $dates = ['deleted_at'];
    protected $table = 'seller_payments';

    /**
     * SellerPayment belongs to Seller.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
    	// belongsTo(RelatedModel, foreignKey = seller_id, keyOnRelatedModel = seller_id)
    	return $this->belongsTo('App\Seller','seller_id','seller_id');
    }

    /**
     * SellerPayment belongs to PaymentMethod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
    	// belongsTo(RelatedModel, foreignKey = pay_m_id, keyOnRelatedModel = pay_m_id)
    	return $this->belongsTo('App\PaymentMethod','pay_m_id','pay_m_id');
    }

    /**
     * SellerPayment has many SellerPaymentByWebsites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerPaymentByWebsites()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = seller_Pay_id, localKey = seller_pay_id)
        return $this->hasMany('App\SellerPaymentByWebsite','seller_pay_id','seller_pay_id');
    }
}
