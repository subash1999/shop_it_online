<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;
    protected $primaryKey='email_id';
    protected $dates = ['deleted_at'];
    protected $table = 'emails';

    /**
     * Email has many Emails.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = email_id, localKey = id)
    	return $this->hasMany(Email::class,'email_id','email_id');
    }
}
