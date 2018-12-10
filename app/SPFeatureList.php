<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SPFeatureList extends Model
{
    use SoftDeletes;
    protected $primaryKey='spfl_id';
    protected $dates = ['deleted_at'];
    protected $table = 's_p_feature_lists';

    /**
     * SPFeatureList belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }
}
