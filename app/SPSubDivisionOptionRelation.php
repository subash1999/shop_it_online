<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SPSubDivisionOptionRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='spsdorid';
    protected $dates = ['deleted_at'];
    protected $table = 's_p_sub_division_option_relations';

    /**
     * SPSubDivisionOption belongs to SPSubDivision.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SPSubDivision()
    {
    	// belongsTo(RelatedModel, foreignKey = spsd_id, keyOnRelatedModel = spsd_id)
    	return $this->belongsTo('App\SPSubDivision','spsd_id','spsd_id');
    }

   
    
}
