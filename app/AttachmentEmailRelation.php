<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachmentEmailRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='attachment_email_relation_id';
    protected $dates = ['deleted_at'];
    protected $table = 'attachment_email_relations';

    /**
     * AttachmentEmailRelation belongs to EmailAttachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function emailAttachment()
    {
    	// belongsTo(RelatedModel, foreignKey = email_attachment_id, keyOnRelatedModel = email_attachment_id)
    	return $this->belongsTo(EmailAttachment::class,'email_attachment_id','email_attachment_id');
    }

    /**
     * AttachmentEmailRelation belongs to Email.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function email()
    {
    	// belongsTo(RelatedModel, foreignKey = email_id, keyOnRelatedModel = email_id)
    	return $this->belongsTo(Email::class,'email_id','email_id');
    }
}
