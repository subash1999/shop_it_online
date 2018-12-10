<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerificationCode extends Model
{
    use SoftDeletes;
    protected $primaryKey='verify_code_id';
    protected $dates = ['deleted_at'];
    protected $table = 'verification_codes';

    /**
     * VerificationCode belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','user_id','user_id');
    }
}
