<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemDefault extends Model
{
    use SoftDeletes;
    protected $primaryKey='system_default_id';
    protected $dates = ['deleted_at'];
    protected $table = 'system_defaults';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;
    
}
