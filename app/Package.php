<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    protected $primaryKey='pac_id';
    protected $dates = ['deleted_at'];
    protected $table = 'packages';

    /**
     * Package has many Offers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = pac_id, localKey = pac_id)
    	return $this->hasMany('App\Offer','pac_id','pac_id');
    }

    /**
     * Package has many PackageProductRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packageProductRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = pac_id, localKey = pac_id)
        return $this->hasMany('App\PackageProductRelation','pac_id','pac_id');
    }

    /**
     * Package has many TransistionHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transistionHistories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = pac_id, localKey = pac_id)
        return $this->hasMany('App\TransistionHistory','pac_id','pac_id');
    }
}
