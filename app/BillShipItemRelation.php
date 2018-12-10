<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillShipItemRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='bsir_id';
    protected $dates = ['deleted_at'];
    protected $table = 'bill_ship_item_relations';

    /**
     * BillShipItemRelation belongs to Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
    	// belongsTo(RelatedModel, foreignKey = item_id, keyOnRelatedModel = item_id)
    	return $this->belongsTo('App\Item','item_id','item_id');
    }

    /**
     * BillShipItemRelation belongs to Bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
    	// belongsTo(RelatedModel, foreignKey = bill_id, keyOnRelatedModel = bill_id)
    	return $this->belongsTo('App\Bill','bill_id','bill_id');
    }
}
