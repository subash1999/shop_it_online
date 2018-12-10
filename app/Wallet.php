<?php

namespace App;

use App\Currency;
use App\Http\Helpers\UserHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use SoftDeletes;
    protected $primaryKey='wallet_id';
    protected $dates = ['deleted_at'];
    protected $table = 'wallets';

    /**
     * Wallet belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','user_id','user_id');
    }

    public function getAmountInCurrencyGiven($curr_id)
    {

     $from_curr = Currency::find($this->curr_id);
     $to_curr = Currency::find($curr_id);
     $usd_amount = $this->amount/$from_curr->per_usd_value;
     $to_amount = $usd_amount * $to_curr->per_usd_value;
     return round($to_amount,2);

 }

 public function getAmountInCurrentCurrency()
 {
    $u_h = new UserHelper;
    $to_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
    $from_curr = Currency::find($this->curr_id);
    $to_curr = Currency::find($to_curr_id);
    $usd_amount = $this->amount/$from_curr->per_usd_value;
    $to_amount = $usd_amount * $to_curr->per_usd_value;
    return round($to_amount,2);

}
public function getCreditInCurrentCurrency()
 {
    $u_h = new UserHelper;
    $to_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
    $from_curr = Currency::find($this->curr_id);
    $to_curr = Currency::find($to_curr_id);
    $usd_amount = $this->credit/$from_curr->per_usd_value;
    $to_amount = $usd_amount * $to_curr->per_usd_value;
    return round($to_amount,2);

}
public function getDebitInCurrentCurrency()
 {
    $u_h = new UserHelper;
    $to_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
    $from_curr = Currency::find($this->curr_id);
    $to_curr = Currency::find($to_curr_id);
    $usd_amount = $this->debit/$from_curr->per_usd_value;
    $to_amount = $usd_amount * $to_curr->per_usd_value;
    return round($to_amount,2);

}


}
