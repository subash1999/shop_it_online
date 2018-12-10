<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnedItem extends Model
{
    use SoftDeletes;
    protected $primaryKey='ret_item_id';
    protected $dates = ['deleted_at'];
    protected $table = 'returned_items';

    /**
     * ReturnedItem belongs to Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
    	// belongsTo(RelatedModel, foreignKey = item_id, keyOnRelatedModel = item_id)
    	return $this->belongsTo('App\Item','item_id','item_id');
    }

    /**
     * ReturnedItem belongs to Bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
    	// belongsTo(RelatedModel, foreignKey = bill_id, keyOnRelatedModel = bill_id)
    	return $this->belongsTo('App\Bill','bill_id','bill_id');
    }

    /**
     * ReturnedItem belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
    	// belongsTo(RelatedModel, foreignKey = curr_id, keyOnRelatedModel = curr_id)
    	return $this->belongsTo('App\Currency','curr_id','curr_id');
    }
}
