<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentMethod extends Model
{
    use SoftDeletes;
    protected $primaryKey='ship_m_id';
    protected $dates = ['deleted_at'];
    protected $table = 'shipment_methods';

    /**
     * ShipmentMethod has many Shipments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipments()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = ship_m_id, localKey = ship_m_id)
    	return $this->hasMany('App\Shipment','ship_m_id','ship_m_id');
    }

    
}
