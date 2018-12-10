<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerPaymentByWebsite extends Model
{
    use SoftDeletes;
    protected $primaryKey='spbw_id';
    protected $dates = ['deleted_at'];
    protected $table = 'seller_payment_by_websites';

    /**
     * SellerPaymentByWebsite belongs to TransistionHistory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transistionHistory()
    {
    	// belongsTo(RelatedModel, foreignKey = th_id, keyOnRelatedModel = th_id)
    	return $this->belongsTo('App\TransistionHistory','th_id','th_id');
    }

    /**
     * SellerPaymentByWebsite belongs to SellerPayment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerPayment()
    {
    	// belongsTo(RelatedModel, foreignKey = seller_pay_id, keyOnRelatedModel = seller_pay_id)
    	return $this->belongsTo('App\SellerPayment','seller_pay_id','seller_pay_id');
    }
}
