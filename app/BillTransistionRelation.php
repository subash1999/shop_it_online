<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillTransistionRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='btr_id';
    protected $dates = ['deleted_at'];
    protected $table = 'bill_transistion_relations';

    /**
     * BillTransistionRelation belongs to Bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
    	// belongsTo(RelatedModel, foreignKey = bill_id, keyOnRelatedModel = bill_id)
    	return $this->belongsTo('App\Bill','bill_id','bill_id');
    }

    /**
     * BillTransistionRelation belongs to TransistionHistory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transistionHistory()
    {
    	// belongsTo(RelatedModel, foreignKey = th_id, keyOnRelatedModel = th_id)
    	return $this->belongsTo('App\TransistionHistory','th_id','th_id');
    }
}
