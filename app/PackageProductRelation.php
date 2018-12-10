<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageProductRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='ppr_id';
    protected $dates = ['deleted_at'];
    protected $table = 'package_product_relations';

    /**
     * PackageProductRelation belongs to Package.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
    	// belongsTo(RelatedModel, foreignKey = pac_id, keyOnRelatedModel = pac_id)
    	return $this->belongsTo('App\Package','pac_id','pac_id');
    }

    /**
     * PackageProductRelation belongs to Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }
}
