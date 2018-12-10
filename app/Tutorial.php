<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutorial extends Model
{
    use SoftDeletes;
    protected $primaryKey='tutorial_id';
    protected $dates = ['deleted_at'];
    protected $table = 'tutorials';
}
