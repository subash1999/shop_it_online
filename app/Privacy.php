<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Privacy extends Model
{
    use SoftDeletes;
    protected $primaryKey='pri_id';
    protected $dates = ['deleted_at'];
    protected $table = 'privacies';

    
}
