<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SellerStockHistory extends Model
{
	use SoftDeletes;
    protected $primaryKey='ssh_id';
    protected $dates = ['deleted_at'];
    protected $table = 'seller_stock_histories';

    /**
     * SellerStockHistory belongs to SellerStock.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerStock()
    {
    	// belongsTo(RelatedModel, foreignKey = ss_id, keyOnRelatedModel = ss_id)
    	return $this->belongsTo('App\SellerStock','ss_id','ss_id');
    }

    /**
     * SellerStockHistory belongs to SPSubDivision.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SPSubDivision()
    {
    	// belongsTo(RelatedModel, foreignKey = spsd_id, keyOnRelatedModel = spsd_id)
    	return $this->belongsTo('App\SPSubDivision','spsd_id','spsd_id');
    }
}
