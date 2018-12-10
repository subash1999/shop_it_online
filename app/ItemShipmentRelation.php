<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemShipmentRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='item_ship_rel_id';
    protected $dates = ['deleted_at'];
    protected $table = 'item_shipment_relations';

    /**
     * ItemShipmentRelation belongs to Shipment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipment()
    {
    	// belongsTo(RelatedModel, foreignKey = shipment_id, keyOnRelatedModel = shipment_id)
    	return $this->belongsTo('App\Shipment','shipment_id','shipment_id');
    }

    /**
     * ItemShipmentRelation belongs to Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
    	// belongsTo(RelatedModel, foreignKey = item_id, keyOnRelatedModel = item_id)
    	return $this->belongsTo('App\Item','item_id','item_id');
    }
}
