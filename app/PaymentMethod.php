<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
	use SoftDeletes;
	protected $primaryKey='pay_m_id';
	protected $dates = ['deleted_at'];
	protected $table = 'payment_methods';

	public function scopeCashOnDelivery($query)
	{		
		return $query->whereIn('method','Cash On Delivery');
	}
	
	/**
	     * PaymentMethod has many SellerPayments.
	     *
	     * @return \Illuminate\Database\Eloquent\Relations\HasMany
	     */
	public function sellerPayments()
	{
	    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = pay_m_id, localKey = pay_m_id)
		return $this->hasMany('App\SellerPayment','pay_m_id','pay_m_id');
	}  

	    /**
	       * PaymentMethod has many Payments.
	       *
	       * @return \Illuminate\Database\Eloquent\Relations\HasMany
	       */
	    public function payments()
	    {
	      	// hasMany(RelatedModel, foreignKeyOnRelatedModel = pay_m__id, localKey = pay_m_id)
	    	return $this->hasMany('App\Payment','pay_m_id','pay_m_id');
	    }  

	      /**
	       * PaymentMethod has many SPPaymentRelations.
	       *
	       * @return \Illuminate\Database\Eloquent\Relations\HasMany
	       */
	      public function SPPaymentRelations()
	      {
	      	// hasMany(RelatedModel, foreignKeyOnRelatedModel = pay_m_id, localKey = pay_m_id)
	      	return $this->hasMany('App\SPPaymentRelation','pay_m_id','pay_m_id');
	      }
	  }
