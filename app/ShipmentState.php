<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentState extends Model
{
    use SoftDeletes;
    protected $primaryKey='ship_state_id';
    protected $dates = ['deleted_at'];
    protected $table = 'shipment_states';

    /**
     * ShipmentState has many Shipments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipments()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = ship_state_id, localKey = ship_state_id)
    	return $this->hasMany('App\Shipment','ship_state_id','ship_state_id');
    }
}
