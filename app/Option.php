<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;
    protected $primaryKey='option_id';
    protected $dates = ['deleted_at'];
    protected $table = 'options';

    /**
     * Option belongs to OptionGroup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function optionGroup()
    {
    	// belongsTo(RelatedModel, foreignKey = option_g_id, keyOnRelatedModel = option_g_id)
    	return $this->belongsTo('App\OptionGroup','option_g_id','option_g_id');
    }

    /**
     * Option has many ProductOptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOptions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = option_id, localKey = option_id)
        return $this->hasMany('App\ProductOption','option_id','option_id');
    }

    /**
     * Option has many SPOptionRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPOptionRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = option_id, localKey = id)
        return $this->hasMany(SPOptionRelation::class,'option_id','option_id');
    }

    /**
     * Option has many SPOptionRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parent_SPOptionRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = option_id, localKey = id)
        return $this->hasMany(SPOptionRelation::class,'parent_option_id','option_id');
    }
}
