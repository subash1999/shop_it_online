<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $primaryKey='payment_id';
    protected $dates = ['deleted_at'];
    protected $table = 'payments';

    /**
     * Payment belongs to Bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
    	// belongsTo(RelatedModel, foreignKey = bill_id, keyOnRelatedModel = bill_id)
    	return $this->belongsTo('App\Bill','bill_id','bill_id');
    }

    /**
     * Payment belongs to PaymentMethod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
    	// belongsTo(RelatedModel, foreignKey = pay_m_id, keyOnRelatedModel = pay_m_id)
    	return $this->belongsTo('App\PaymentMethod','pay_m_id','pay_m_id');
    }

    /**
     * Payment belongs to PaymentState.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentState()
    {
    	// belongsTo(RelatedModel, foreignKey = pay_state_id, keyOnRelatedModel = pay_state_id)
    	return $this->belongsTo('App\PaymentState','pay_state_id','pay_state_id');
    }
}
