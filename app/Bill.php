<?php

namespace App;

use App\Http\Helpers\UserHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;
    protected $primaryKey='bill_id';
    protected $dates = ['deleted_at'];
    protected $table = 'bills';

    public function getTotalAmountInCurrentCurrency()
 {
    $u_h = new UserHelper;
    $to_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
    $from_curr = Currency::find($this->curr_id);
    $to_curr = Currency::find($to_curr_id);
    $usd_amount = $this->total_amount/$from_curr->per_usd_value;
    $to_amount = $usd_amount * $to_curr->per_usd_value;
    return round($to_amount,2);

}
public function getFinalAmountInCurrentCurrency()
 {
    $u_h = new UserHelper;
    $to_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
    $from_curr = Currency::find($this->curr_id);
    $to_curr = Currency::find($to_curr_id);
    $usd_amount = $this->final_amount/$from_curr->per_usd_value;
    $to_amount = $usd_amount * $to_curr->per_usd_value;
    return round($to_amount,2);

}
public function getDiscountAmountInCurrentCurrency()
 {
    $u_h = new UserHelper;
    $to_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
    $from_curr = Currency::find($this->curr_id);
    $to_curr = Currency::find($to_curr_id);
    $usd_amount = $this->discount_amount/$from_curr->per_usd_value;
    $to_amount = $usd_amount * $to_curr->per_usd_value;
    return round($to_amount,2);

}

    /**
     * Bill has many BillTransistionRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billTransistionRelations()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = bill_id, localKey = id)
    	return $this->hasMany('App\BillTransistionRelation','bill_id','bill_id');
    }
 /**
     * TransistionHistory belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
 public function currency()
 {
        // belongsTo(RelatedModel, foreignKey = curr_id, keyOnRelatedModel = curr_id)
    return $this->belongsTo('App\Currency','curr_id','curr_id');
}

    /**
     * TransistionHistory belongs to DiscountCoupon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discountCoupon()
    {
        // belongsTo(RelatedModel, foreignKey = dc_id, keyOnRelatedModel = dc_id)
        return $this->belongsTo('App\DiscountCoupon','dc_id','dc_id');
    }
    
    /**
     * Bill belongs to SPSubDivision.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SPSubDivision()
    {
        // belongsTo(RelatedModel, foreignKey = spsd_id, keyOnRelatedModel = spsd_id)
        return $this->belongsTo('App\SPSubDivision','spsd_id','spsd_id');
    }

     public function user()
    {
        // belongsTo(RelatedModel, foreignKey = spsd_id, keyOnRelatedModel = spsd_id)
        return $this->belongsTo('App\User','user_id','user_id');
    }
    /**
     * Bill has many Payments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = bill_id, localKey = bill_id)
        return $this->hasMany('App\Payment','bill_id','bill_id');
    }

    /**
     * Bill has many BillShipItemRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billShipItemRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = bill_id, localKey = bill_id)
        return $this->hasMany('App\BillShipItemRelation','bill_id','bill_id');
    }
    
    /**
     * Bill has many ReturnedItems.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function returnedItems()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = bill_id, localKey = bill_id)
        return $this->hasMany('App\ReturnedItem','bill_id','bill_id');
    }
}
