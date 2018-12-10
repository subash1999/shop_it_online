<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemUniqueValue extends Model
{
     use SoftDeletes;
    protected $primaryKey='iuv_id';
    protected $dates = ['deleted_at'];
    protected $table = 'item_unique_values';

    /**
     * ItemUniqueValue belongs to Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
    	// belongsTo(RelatedModel, foreignKey = item_id, keyOnRelatedModel = item_id)
    	return $this->belongsTo('App\Item','item_id','item_id');
    }

    /**
     * ItemUniqueValue belongs to SPUniqueProperty.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SPUniqueProperty()
    {
    	// belongsTo(RelatedModel, foreignKey = spup_id, keyOnRelatedModel = spup_id)
    	return $this->belongsTo('App\SPUniqueProperty','spup_id','spup_id');
    }
}
