<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $primaryKey='item_id';
    protected $dates = ['deleted_at'];
    protected $table = 'items';

    /**
     * Item belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }

    /**
     * Item belongs to TransistionHistory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transistionHistory()
    {
    	// belongsTo(RelatedModel, foreignKey = th_id, keyOnRelatedModel = th_id)
    	return $this->belongsTo('App\TransistionHistory','th_id','th_id');
    }

    /**
     * Item has many ItemUniqueValues.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemUniqueValues()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = item_id, localKey = item_id)
        return $this->hasMany('App\ItemUniqueValue','iuv_id','iuv_id');
    }

    /**
     * Item has one ItemShipmentRelation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function itemShipmentRelation()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = item_id, localKey = item_id)
        return $this->hasOne('App\ItemShipmentRelation','item_id','item_id');
    }

    /**
     * Item has many BillShipItemRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billShipItemRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = item_id, localKey = item_id)
        return $this->hasMany('App\BillShipItemRelation','item_id','item_id');
    }

    /**
     * Item has many ReturnedItems.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function returnedItems()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = item_id, localKey = item_id)
        return $this->hasMany('App\ReturnedItem','item_id','item_id');
    }
}
