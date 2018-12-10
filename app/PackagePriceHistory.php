<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagePriceHistory extends Model
{
    use SoftDeletes;
    protected $primaryKey='pph_id';
    protected $dates = ['deleted_at'];
    protected $table = 'package_price_histories';
    public function currency()
    {
        // belongsTo(RelatedModel, foreignKey = currency_id, keyOnRelatedModel = id)
        return $this->belongsTo('App\Currency','curr_id','curr_id');
    }
    /**
     * PackagePriceHistory belongs to Package.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
    	// belongsTo(RelatedModel, foreignKey = package_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\Package','pac_id','pac_id');
    }
}
