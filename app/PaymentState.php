<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentState extends Model
{
    use SoftDeletes;
    protected $primaryKey='pay_state_id';
    protected $dates = ['deleted_at'];
    protected $table = 'payment_states';

    /**
     * PaymentState has many Payments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = pay_state_id, localKey = pay_state_id)
    	return $this->hasMany('App\Payment','pay_state_id','pay_state_id');
    }
}
