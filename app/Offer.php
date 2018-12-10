<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;
    protected $primaryKey='offer_id';
    protected $dates = ['deleted_at'];
    protected $table = 'offers';

    /**
     * Offer belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }

    /**
     * Offer belongs to Package.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
    	// belongsTo(RelatedModel, foreignKey = pac_id, keyOnRelatedModel = pac_id)
    	return $this->belongsTo('App\Package','pac_id','pac_id');
    }

    /**
     * Offer has many TransistionHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transistionHistories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = offer_id, localKey = offer_id)
        return $this->hasMany('App\TransistionHistory','offer_id','offer_id');
    }
}
