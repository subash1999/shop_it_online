<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCoupon extends Model
{
    use SoftDeletes;
    protected $primaryKey='dc_id';
    protected $dates = ['deleted_at'];
    protected $table = 'discount_coupons';

    public function scopeValid($query){    
        return $query->where(function ($q) {
         $q->where('from', '<=', Carbon::now());
         $q->where('to', '>=', Carbon::now());
     });

    }
    public function isValid(){    
        if($this->from<= Carbon::now() &&$this->to>=Carbon::now()){
            return true;
        }
        return false;

    }
    public function getDiscountAmount($total)
    {
        $currency_helper = new CurrencyHelper;
        $u_h = new UserHelper;
        $current_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
        if(!$this->isValid()){
            return 0;
        }
        $dis_amount = $currency_helper->currencyConvert($this->curr_id,$current_curr_id,$this->amount);
        if($dis_amount>=0.2*$total){
            $dis_amount=0.2*$total;
        }
        return $dis_amount;
    }
    /**
     * DiscountCoupon belongs to Customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = cus_id, keyOnRelatedModel = cus_id)
    	return $this->belongsTo('App\User','user_id','user_id');
    }

    /**
     * DiscountCoupon has one TransistionHistory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bill()
    {
    	// hasOne(RelatedModel, foreignKeyOnRelatedModel = dc_id, localKey = dc_id)
    	return $this->hasOne('App\Bill','dc_id','dc_id');
    }
    /**
     * DiscountCoupon belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        // belongsTo(RelatedModel, foreignKey = currency_id, keyOnRelatedModel = id)
        return $this->belongsTo('App\Currency','curr_id','curr_id');
    }
}
