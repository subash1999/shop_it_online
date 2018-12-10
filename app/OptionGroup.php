<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionGroup extends Model
{
    use SoftDeletes;
    protected $primaryKey='option_g_id';
    protected $dates = ['deleted_at'];
    protected $table = 'option_groups';

    /**
     * OptionGroup has many Options.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = option_g_id, localKey = option_g_id)
    	return $this->hasMany('App\Option','option_g_id','option_g_id');
    }

    /**
     * OptionGroup has many ProductOptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOptions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = option_g_id, localKey = option_g_id)
        return $this->hasMany('App\ProductOption','option_g_id','option_g_id');
    }
}
