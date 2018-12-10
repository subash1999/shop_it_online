<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SPUniqueProperty extends Model
{
    use SoftDeletes;
    protected $primaryKey='spup_id';
    protected $dates = ['deleted_at'];
    protected $table = 's_p_unique_properties';

    /**
     * SPUniqueProperty belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }

    /**
     * SPUniqueProperty has many ItemUniqueValues.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemUniqueValues()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = spup_id, localKey = spup_id)
        return $this->hasMany('App\ItemUniqueValue','spup_id','spup_id');
    }
}
