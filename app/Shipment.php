<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use SoftDeletes;
    protected $primaryKey='shipment_id';
    protected $dates = ['deleted_at'];
    protected $table = 'shipments';

    /**
     * Shipment belongs to ShipmentMethod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipmentMethod()
    {
    	// belongsTo(RelatedModel, foreignKey = ship_m_id, keyOnRelatedModel = ship_m_id)
    	return $this->belongsTo('App\ShipmentMethod','ship_m_id','ship_m_id');
    }

    /**
     * Shipment belongs to ShipState.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipState()
    {
    	// belongsTo(RelatedModel, foreignKey = ship_state_id, keyOnRelatedModel = ship_state_id)
    	return $this->belongsTo('App\ShipState','ship_sate_id','ship_state_id');
    }

    /**
     * Shipment has many ItemShipmentRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemShipmentRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = shipment_id, localKey = shipment_id)
        return $this->hasMany('App\ItemShipmentRelation','shipment_id','shipment_id');
    }
}
