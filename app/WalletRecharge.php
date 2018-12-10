<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletRecharge extends Model
{
    use SoftDeletes;
    protected $primaryKey='wallet_recharge_id';
    protected $dates = ['deleted_at'];
    protected $table = 'wallet_recharges';

    /**
     * WalletRecharge belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
    	// belongsTo(RelatedModel, foreignKey = curr_id, keyOnRelatedModel = curr_id)
    	return $this->belongsTo(Currency::class,'curr_id','curr_id');
    }
}
