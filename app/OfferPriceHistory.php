<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferPriceHistory extends Model
{
	use SoftDeletes;
	protected $primaryKey='oph_id';
	protected $dates = ['deleted_at'];
	protected $table = 'offer_price_histories';

	public function currency()
	{
        // belongsTo(RelatedModel, foreignKey = currency_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\Currency','curr_id','curr_id');
	}

	/**
	 * OfferPriceHistory belongs to Offer.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function offer()
	{
		// belongsTo(RelatedModel, foreignKey = offer_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\Offer','offer_id','offer_id');
	}


}
