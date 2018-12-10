<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use SoftDeletes;
    protected $primaryKey='guest_id';
    protected $dates = ['deleted_at'];
    protected $table = 'guests';

    /**
     * Guest has many Sessions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = guest_id, localKey = id)
    	return $this->hasMany(Session::class,'guest_id','guest_id');
    }
}
