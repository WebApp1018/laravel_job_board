<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proximity extends Model
{
    protected $table = 'proximity';
    public $fillable = ['id','cat_id','project_id','type','title','created_at','updated_at'];
}