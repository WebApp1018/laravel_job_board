<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectRevision extends Model
{
    //
    public $fillable = ['id','project_id','revision','created_at','updated_at'];
}
