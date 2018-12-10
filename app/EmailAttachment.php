<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailAttachment extends Model
{
    use SoftDeletes;
    protected $primaryKey='email_attachment_id';
    protected $dates = ['deleted_at'];
    protected $table = 'email_attachments';

    /**
     * EmailAttachment has many AttachmentEmailRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachmentEmailRelations()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = email_attachment_id, localKey = email_attachment_id)
    	return $this->hasMany(AttachmentEmailRelation::class,'email_attachment_id','email_attachment_id');
    }
}
