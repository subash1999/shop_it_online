<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPrivacy extends Model
{
    use SoftDeletes;
    protected $primaryKey='cus_pri_id';
    protected $dates = ['deleted_at'];
    protected $table = 'customer_privacies';

    /**
     * CustomerPrivacy belongs to Customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
    	// belongsTo(RelatedModel, foreignKey = customer_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\Customer','cus_id','cus_id');
    }
}
